<?php

namespace App\Http\Controllers;

use App\Models\Button;
use Illuminate\Http\Request;

class ButtonController extends Controller
{
    // Display a list of buttons on the dashboard
    public function index()
    {
        $user = auth()->user();
        $buttons = Button::where('user_id', $user->id)->get();

        return inertia('Dashboard', [
            'buttons' => $buttons,
        ]);
    }

    // Show a form to configure a button
    public function edit($id)
    {
        $button = Button::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        return inertia('ConfigureButton', [
            'button' => $button,
        ]);
    }

    // Update button configuration
    public function update(Request $request, $id)
    {
        $button = Button::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        $request->validate([
            'label' => 'required|string|max:255',
            'color' => 'required|string',
            'link' => 'nullable|url', // Optional but must be a valid URL
        ]);

        $button->update([
            'label' => $request->input('label'),
            'color' => $request->input('color'),
            'link' => $request->input('link'),
        ]);

        return redirect()->route('dashboard')->with('success', 'Button updated successfully!');
    }

    // Delete a button
    public function destroy(Request $request, $id)
    {
        $button = Button::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $button->delete();

        return redirect()->route('dashboard')->with('success', 'Button deleted successfully!');
    }

}
