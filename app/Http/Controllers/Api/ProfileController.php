<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CompanyValue;
use App\Models\Inspector;
use App\Models\Partner;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // --- SERVICES CRUD ---

    public function servicesIndex()
    {
        $services = Service::orderBy('title')->get();
        return response()->json([
            'id' => '1',
            'data' => $services
        ]);
    }

    public function servicesStore(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'required|string|max:255',
        ]);

        $service = Service::create($validated);

        return response()->json([
            'id' => '1',
            'message' => 'Service created successfully',
            'data' => $service
        ], 201);
    }

    public function servicesShow($id)
    {
        $service = Service::find($id);
        if (!$service) {
            return response()->json([
                'id' => '0',
                'message' => 'Service not found'
            ], 404);
        }

        return response()->json([
            'id' => '1',
            'data' => $service
        ]);
    }

    public function servicesUpdate(Request $request, $id)
    {
        $service = Service::find($id);
        if (!$service) {
            return response()->json([
                'id' => '0',
                'message' => 'Service not found'
            ], 404);
        }

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'icon' => 'sometimes|required|string|max:255',
        ]);

        $service->update($validated);

        return response()->json([
            'id' => '1',
            'message' => 'Service updated successfully',
            'data' => $service
        ]);
    }

    public function servicesDestroy($id)
    {
        $service = Service::find($id);
        if (!$service) {
            return response()->json([
                'id' => '0',
                'message' => 'Service not found'
            ], 404);
        }

        $service->delete();

        return response()->json([
            'id' => '1',
            'message' => 'Service deleted successfully'
        ]);
    }


    // --- COMPANY VALUES CRUD ---
    // (Struktur yang sama dengan Services, hanya modelnya yang berbedan)

    public function valuesIndex()
    {
        $values = CompanyValue::orderBy('title')->get();
        return response()->json(['id' => '1', 'data' => $values]);
    }

    public function valuesStore(Request $request)
    {
        $validated = $request->validate(['title' => 'required|string|max:255', 'description' => 'required|string', 'icon' => 'required|string|max:255']);
        $value = CompanyValue::create($validated);
        return response()->json(['id' => '1', 'message' => 'Value created successfully', 'data' => $value], 201);
    }

    public function valuesShow($id)
    {
        $value = CompanyValue::find($id);
        if (!$value) {
            return response()->json(['id' => '0', 'message' => 'Value not found'], 404);
        }
        return response()->json(['id' => '1', 'data' => $value]);
    }

    public function valuesUpdate(Request $request, $id)
    {
        $value = CompanyValue::find($id);
        if (!$value) {
            return response()->json(['id' => '0', 'message' => 'Value not found'], 404);
        }
        $validated = $request->validate(['title' => 'sometimes|required|string|max:255', 'description' => 'sometimes|required|string', 'icon' => 'sometimes|required|string|max:255']);
        $value->update($validated);
        return response()->json(['id' => '1', 'message' => 'Value updated successfully', 'data' => $value]);
    }

    public function valuesDestroy($id)
    {
        $value = CompanyValue::find($id);
        if (!$value) {
            return response()->json(['id' => '0', 'message' => 'Value not found'], 404);
        }
        $value->delete();
        return response()->json(['id' => '1', 'message' => 'Value deleted successfully']);
    }


    // --- INSPECTORS CRUD (Dengan Upload File) ---

    public function inspectorsIndex()
    {
        $inspectors = Inspector::orderBy('name')->get();
        return response()->json(['id' => '1', 'data' => $inspectors]);
    }

    public function inspectorsStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'no_hp' => 'required|numeric'
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('inspectors', 'public');
            $validated['image'] = $path;
        }

        $inspector = Inspector::create($validated);
        return response()->json(['id' => '1', 'message' => 'Inspector created successfully', 'data' => $inspector], 201);
    }

    public function inspectorsShow($id)
    {
        $inspector = Inspector::find($id);
        if (!$inspector) {
            return response()->json(['id' => '0', 'message' => 'Inspector not found'], 404);
        }
        return response()->json(['id' => '1', 'data' => $inspector]);
    }

    public function inspectorsUpdate(Request $request, $id)
    {
        $inspector = Inspector::find($id);
        if (!$inspector) {
            return response()->json(['id' => '0', 'message' => 'Inspector not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'title' => 'sometimes|required|string|max:255',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            'no_hp' => 'sometimes|required|numeric'
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama
            if ($inspector->image) {
                Storage::disk('public')->delete($inspector->image);
            }
            // Simpan gambar baru
            $path = $request->file('image')->store('inspectors', 'public');
            $validated['image'] = $path;
        }

        $inspector->update($validated);
        return response()->json(['id' => '1', 'message' => 'Inspector updated successfully', 'data' => $inspector]);
    }

    public function inspectorsDestroy($id)
    {
        $inspector = Inspector::find($id);
        if (!$inspector) {
            return response()->json(['id' => '0', 'message' => 'Inspector not found'], 404);
        }

        if ($inspector->image) {
            Storage::disk('public')->delete($inspector->image);
        }

        $inspector->delete();
        return response()->json(['id' => '1', 'message' => 'Inspector deleted successfully']);
    }


    // --- PARTNERS CRUD (Dengan Upload File) ---
    // (Struktur yang sama dengan Inspectors)

    public function partnersIndex()
    {
        $partners = Partner::orderBy('name')->get();
        return response()->json(['id' => '1', 'data' => $partners]);
    }

    public function partnersStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo_url' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($request->hasFile('logo_url')) {
            $path = $request->file('logo_url')->store('partners', 'public');
            $validated['logo_url'] = $path;
        }

        $partner = Partner::create($validated);
        return response()->json(['id' => '1', 'message' => 'Partner created successfully', 'data' => $partner], 201);
    }

    public function partnersShow($id)
    {
        $partner = Partner::find($id);
        if (!$partner) {
            return response()->json(['id' => '0', 'message' => 'Partner not found'], 404);
        }
        return response()->json(['id' => '1', 'data' => $partner]);
    }

    public function partnersUpdate(Request $request, $id)
    {
        $partner = Partner::find($id);
        if (!$partner) {
            return response()->json(['id' => '0', 'message' => 'Partner not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'logo_url' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($request->hasFile('logo_url')) {
            if ($partner->logo_url) {
                Storage::disk('public')->delete($partner->logo_url);
            }
            $path = $request->file('logo_url')->store('partners', 'public');
            $validated['logo_url'] = $path;
        }

        $partner->update($validated);
        return response()->json(['id' => '1', 'message' => 'Partner updated successfully', 'data' => $partner]);
    }

    public function partnersDestroy($id)
    {
        $partner = Partner::find($id);
        if (!$partner) {
            return response()->json(['id' => '0', 'message' => 'Partner not found'], 404);
        }

        if ($partner->logo_url) {
            Storage::disk('public')->delete($partner->logo_url);
        }

        $partner->delete();
        return response()->json(['id' => '1', 'message' => 'Partner deleted successfully']);
    }



    // --- GALLERIES CRUD ---

    public function galleriesIndex()
    {
        $galleries = \App\Models\Galeri::orderBy('created_at', 'desc')->get();
        return response()->json(['id' => '1', 'data' => $galleries]);
    }

    public function galleriesStore(Request $request)
    {
        $validated = $request->validate([
            'caption' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('galleries', 'public');
            $validated['image'] = $path;
        }

        $gallery = \App\Models\Galeri::create($validated);
        return response()->json(['id' => '1', 'message' => 'Gallery image added successfully', 'data' => $gallery], 201);
    }

    public function galleriesShow($id)
    {
        $gallery = \App\Models\Galeri::find($id);
        if (!$gallery) {
            return response()->json(['id' => '0', 'message' => 'Gallery image not found'], 404);
        }
        return response()->json(['id' => '1', 'data' => $gallery]);
    }

    public function galleriesUpdate(Request $request, $id)
    {
        $gallery = \App\Models\Galeri::find($id);
        if (!$gallery) {
            return response()->json(['id' => '0', 'message' => 'Gallery image not found'], 404);
        }

        $validated = $request->validate([
            'caption' => 'sometimes|required|string|max:255',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            if ($gallery->image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($gallery->image);
            }
            $path = $request->file('image')->store('galleries', 'public');
            $validated['image'] = $path;
        }

        $gallery->update($validated);
        return response()->json(['id' => '1', 'message' => 'Gallery image updated successfully', 'data' => $gallery]);
    }

    public function galleriesDestroy($id)
    {
        $gallery = \App\Models\Galeri::find($id);
        if (!$gallery) {
            return response()->json(['id' => '0', 'message' => 'Gallery image not found'], 404);
        }

        if ($gallery->image) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($gallery->image);
        }

        $gallery->delete();
        return response()->json(['id' => '1', 'message' => 'Gallery image deleted successfully']);
    }
}
