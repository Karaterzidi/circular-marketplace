<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Option;
use App\Models\Choice;

class ChoiceController extends Controller
{
    public function create(Option $option, Request $request)
    {
        //Using Policies to check if option belongs to the user
        $this->authorize('view', $option);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            // 'price' => ['nullable', 'numeric']
        ]);

        $option->choices()->create($validated);

        return redirect()->back();
    }

    public function update(Option $option, Choice $choice, Request $request)
    {
        $this->authorize('view', $option);
        $this->authorize('update', $choice);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            // 'price' => ['nullable', 'numeric']
        ]);

        $choice->update($validated);

        return redirect()->back();
    }

    public function delete(Option $option, Choice $choice)
    {
        $this->authorize('delete', $choice);

        $choice->delete();
        return redirect()->back();
    }
}
