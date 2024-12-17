#!/usr/bin/env python
from __future__ import print_function
import optparse
import os
import re
import sys
import shutil
import bz2

parser = optparse.OptionParser()

parser.add_option('--icudst',
    action='store',
    dest='icudst',
    default='deps/icu-small',
    help='path to target ICU directory. Will be deleted.')

parser.add_option('--icu-src',
    action='store',
    dest='icusrc',
    default='deps/icu',
    help='path to source ICU directory.')

parser.add_option('--icutmp',
    action='store',
    dest='icutmp',
    default='out/Release/obj/gen/icutmp',
    help='path to icutmp dir.')

(options, args) = parser.parse_args()

if os.path.isdir(options.icudst):
    print('Deleting existing icudst %s' % (options.icudst))
    shutil.rmtree(options.icudst)

if not os.path.isdir(options.icusrc):
    print('Missing source ICU dir --icusrc=%s' % (options.icusrc))
    sys.exit(1)

# compression stuff. Keep the suffix and the compression function in sync.
compression_suffix = '.bz2'
def compress_data(infp, outfp):
    with open(infp, 'rb') as inf:
        with bz2.BZ2File(outfp, 'wb') as outf:
            shutil.copyfileobj(inf, outf)

def print_size(fn):
    size = (os.stat(fn).st_size) / 1024000
    print('%dM\t%s' % (size, fn))

ignore_regex = re.compile(r'^.*\.(vcxproj|filters|nrm|icu|dat|xml|txt|ac|guess|m4|in|sub|py|mak)$')

def icu_ignore(dir, files):
    subdir = dir[len(options.icusrc)+1::]
    ign = []
    if len(subdir) == 0:
        # remove all files at root level
        ign = ign + files
        # except...
        ign.remove('source')
        if 'LICENSE' in ign:
            ign.remove('LICENSE')
            # license.html will be removed (it's obviated by LICENSE)
        elif 'license.html' in ign:
            ign.remove('license.html')
    elif subdir == 'source':
        ign = ign + ['layout','samples','test','extra','config','layoutex','allinone','data']
        ign = ign + ['runConfigureICU','install-sh','mkinstalldirs','configure']
        ign = ign + ['io']
    elif subdir == 'source/tools':
        ign = ign + ['tzcode','ctestfw','gensprep','gennorm2','gendict','icuswap',
        'genbrk','gencfu','gencolusb','genren','memcheck','makeconv','gencnval','icuinfo','gentest']
    ign = ign + ['.DS_Store', 'Makefile', 'Makefile.in']

    for file in files:
        if ignore_regex.match(file):
            ign = ign + [file]

    # print '>%s< [%s]' % (subdir, ign)
    return ign

# copied from configure
def icu_info(icu_full_path):
    uvernum_h = os.path.join(icu_full_path, 'source/common/unicode/uvernum.h')
    if not os.path.isfile(uvernum_h):
        print(' Error: could not load %s - is ICU installed?' % uvernum_h)
        sys.exit(1)
    icu_ver_major = None
    matchVerExp = r'^\s*#define\s+U_ICU_VERSION_SHORT\s+"([^"]*)".*'
    match_version = re.compile(matchVerExp)
    for line in open(uvernum_h).readlines():
        m = match_version.match(line)
        if m:
            icu_ver_major = m.group(1)
    if not icu_ver_major:
        print(' Could not read U_ICU_VERSION_SHORT version from %s' % uvernum_h)
        sys.exit(1)
    icu_endianness = sys.byteorder[0]  # TODO(srl295): EBCDIC should be 'e'
    return (icu_ver_major, icu_endianness)

(icu_ver_major, icu_endianness) = icu_info(options.icusrc)
print("Data file root: icudt%s%s" % (icu_ver_major, icu_endianness))
dst_datafile = os.path.join(options.icudst, "source","data","in", "icudt%s%s.dat" % (icu_ver_major, icu_endianness))

src_datafile = os.path.join(options.icusrc, "source/data/in/icudt%sl.dat" % (icu_ver_major))
dst_cmp_datafile = "%s%s" % (dst_datafile, compression_suffix)

if not os.path.isfile(src_datafile):
    print("Error: icu data file not found: %s" % src_datafile)
    exit(1)

print("will use datafile %s" % (src_datafile))

print('%s --> %s' % (options.icusrc, options.icudst))
shutil.copytree(options.icusrc, options.icudst, ignore=icu_ignore)

# now, make the data dir (since we ignored it)
icudst_data = os.path.join(options.icudst, "source", "data")
icudst_in = os.path.join(icudst_data, "in")
os.mkdir(icudst_data)
os.mkdir(icudst_in)

print_size(src_datafile)

print('%s --compress-> %s' % (src_datafile, dst_cmp_datafile))
compress_data(src_datafile, dst_cmp_datafile)
print_size(dst_cmp_datafile)
readme_name = os.path.join(options.icudst, "README-FULL-ICU.txt" )

# Now, print a short notice
msg_fmt = """\
ICU sources - auto generated by shrink-icu-src.py\n
This directory contains the ICU subset used by --with-intl=full-icu
It is a strict subset of ICU {} source files with the following exception(s):
* {} : compressed data file\n\n
To rebuild this directory, see ../../tools/icu/README.md\n"""

with open(readme_name, 'w') as out_file:
    print(msg_fmt.format(icu_ver_major, dst_cmp_datafile), file=out_file)
