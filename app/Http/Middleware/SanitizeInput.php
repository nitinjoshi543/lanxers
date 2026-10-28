<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SanitizeInput
{
    // Fields that are allowed to contain HTML
    private array $allowedHtmlFields = [
        'description',
        'content',
        'body',
        'terms',
    ];

    public function handle(Request $request, Closure $next)
    {
        if ($request->is('admin/page-editor/*')) {
            return $next($request);
        }

        $data = $this->clean($request->all());

        $request->merge($data);

        return $next($request);
    }

    private function clean($data)
    {
        foreach ($data as $key => $value) {

            if (is_array($value)) {
                $data[$key] = $this->clean($value);

            } elseif (is_string($value)) {

                // Skip strip_tags() for HTML editor fields
                if (in_array($key, $this->allowedHtmlFields)) {
                    $value = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/u', '', $value);
                    $data[$key] = trim($value);
                    continue;
                }

                // Sanitize normal text fields
                $value = strip_tags($value);
                $value = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/u', '', $value);
                $value = trim($value);

                $data[$key] = $value;
            }
        }

        return $data;
    }
}