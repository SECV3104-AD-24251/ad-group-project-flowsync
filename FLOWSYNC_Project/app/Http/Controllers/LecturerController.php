
// LecturerController.php
public function index() {
    $lecturers = Lecturer::all();  // Get all lecturers
    return response()->json($lecturers);
}

public function store(Request $request) {
    $validated = $request->validate([
        'name' => 'required|string',
        'course_code' => 'required|string',
        'section' => 'required|string',
        'time_slot' => 'required|string'
    ]);

    $lecturer = Lecturer::create($validated);

    return response()->json(['success' => true, 'lecturer' => $lecturer]);
}

public function destroy($id) {
    $lecturer = Lecturer::findOrFail($id);
    $lecturer->delete();

    return response()->json(['success' => true]);
}
