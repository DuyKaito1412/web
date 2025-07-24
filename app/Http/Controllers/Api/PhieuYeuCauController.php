<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PhieuYeuCau;
use App\Http\Resources\PhieuYeuCauResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PhieuYeuCauController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        $user = Auth::user();
        $query = PhieuYeuCau::query();
        if ($user->vai_tro === 'user') {
            $query->where('user_id', $user->id);
        }
        $phieuYeuCau = $query->paginate(10);
        return PhieuYeuCauResource::collection($phieuYeuCau);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            // Thêm các rule phù hợp
        ]);
        $data['user_id'] = Auth::id();
        $phieu = PhieuYeuCau::create($data);
        return new PhieuYeuCauResource($phieu);
    }

    public function show(PhieuYeuCau $phieuYeuCau)
    {
        $this->authorize('view', $phieuYeuCau);
        return new PhieuYeuCauResource($phieuYeuCau);
    }

    public function update(Request $request, PhieuYeuCau $phieuYeuCau)
    {
        $this->authorize('update', $phieuYeuCau);
        $data = $request->validate([
            // Thêm các rule phù hợp
        ]);
        $phieuYeuCau->update($data);
        return new PhieuYeuCauResource($phieuYeuCau);
    }

    public function destroy(PhieuYeuCau $phieuYeuCau)
    {
        $this->authorize('delete', $phieuYeuCau);
        $phieuYeuCau->delete();
        return response()->json(['message' => 'Đã xóa phiếu yêu cầu']);
    }
}
