<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TestimonialController extends Controller
{
    public function index(): View
    {
        $testimonials = Testimonial::query()->latest('id')->paginate(15);

        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create(): View
    {
        return view('admin.testimonials.create', ['testimonial' => new Testimonial]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'image' => ['nullable', 'image', 'max:5120'],
        ]);
        $data = $this->validated($request);
        $data['image'] = $request->hasFile('image')
            ? $request->file('image')->store('testimonials', 'public')
            : null;
        Testimonial::query()->create($data);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial created.');
    }

    public function edit(Testimonial $testimonial): View
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial): RedirectResponse
    {
        $request->validate([
            'image' => ['nullable', 'image', 'max:5120'],
        ]);
        $data = $this->validated($request);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('testimonials', 'public');
        } else {
            unset($data['image']);
        }
        $testimonial->update($data);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial updated.');
    }

    public function destroy(Testimonial $testimonial): RedirectResponse
    {
        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial deleted.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'rating' => ['nullable', 'integer', 'min:1', 'max:5'],
        ]);
        $data['rating'] = (int) ($data['rating'] ?? 5);
        $data['is_approved'] = $request->boolean('is_approved');
        $data['is_featured'] = $request->boolean('is_featured');

        return $data;
    }
}
