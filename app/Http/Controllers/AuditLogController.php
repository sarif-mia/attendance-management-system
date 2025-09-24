<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;

class AuditLogController extends Controller
{
    public function index()
    {
        $logs = AuditLog::with('user')->orderBy('created_at', 'desc')->limit(100)->get();
        return view('admin.audit_logs', compact('logs'));
    }
}
