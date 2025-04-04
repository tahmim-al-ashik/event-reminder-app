<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Event;
use League\Csv\Reader;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CSVImportController extends Controller
{
    public function showForm()
    {
        return view('events.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt'
        ]);

        $file = $request->file('csv_file');
        $csv = Reader::createFromPath($file->getRealPath(), 'r');
        $csv->setHeaderOffset(0);

        foreach ($csv as $row) {
            Event::create([
                'event_id' => 'EVT-' . strtoupper(Str::random(6)),
                'title' => $row['title'] ?? 'Untitled',
                'description' => $row['description'] ?? '',
                'event_time' => $row['event_time'] ?? now(),
                'email' => $row['email'] ?? null,
            ]);
        }

        return redirect()->route('events.index')->with('success', 'CSV imported successfully!');
    }

    public function export()
    {
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=events.csv",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $callback = function() {
            $handle = fopen('php://output', 'w');

            // Add CSV headers
            fputcsv($handle, ['event_id', 'title', 'description', 'event_time', 'email']);

            // Add rows
            foreach (Event::all() as $event) {
                fputcsv($handle, [
                    $event->event_id,
                    $event->title,
                    $event->description,
                    $event->event_time,
                    $event->email,
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}
