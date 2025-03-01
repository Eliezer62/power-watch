<?php

namespace App\Http\Services;

use App\Exceptions\ReportException;
use App\Http\Requests\ReportRequest;
use App\Models\Report;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ReportService
{
    public function create(ReportRequest $request)
    {
        try {
            $report = Report::create($request->all());
            $report->saveOrFail();
            return $report;
        } catch (\Exception $exception) {
            throw new ReportException('Error creating report', 500);
        }
    }

    public function findAll()
    {
        return Report::query()->orderBy('created_at', 'desc')->get();
    }

    public function findById($id) {
        try {
            return Report::query()->findOrFail($id);
        } catch (ModelNotFoundException $exception) {
            throw new ReportException('Report not found', 404);
        } catch (\Exception $exception) {
            throw new ReportException('Error finding report', 500);
        }
    }

    public function update(ReportRequest $request, $id)
    {
        try {
            $report = Report::query()->findOrFail($id);
            $report->updateOrFail($request->all());
            return $report;
        } catch (ModelNotFoundException $exception) {
            throw new ReportException('Report not found', 404);
        }
        catch (\Exception $exception) {
            throw new ReportException('Error updating report', 500);
        }
    }

    public function patch(Request $request, $id) {
        try {
            $report = Report::query()->findOrFail($id);
            $report->update($request->all());
            return $report;
        } catch (ModelNotFoundException $exception) {
            throw new ReportException('Report not found', 404);
        } catch (\Exception $exception) {
            throw new ReportException('Error updating report', 500);
        }
    }

    public function delete($id) {
        $report = Report::find($id)?->delete();
    }
}
