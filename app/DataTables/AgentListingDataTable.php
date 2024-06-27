<?php

namespace App\DataTables;

use App\Models\Listing;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AgentListingDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {
                $edit = '<a href="' . route('admin.listing.edit', $query->id) . '" class="btn btn-sm btn-primary me-2"><i class="fas fa-edit"></i></a>';
                $delete = '<a href="' . route('admin.listing.destroy', $query->id) . '" class="btn btn-sm btn-danger ml-2 delete-item"><i class="fas fa-trash"></i></a>';
                $more = '<div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle btn-sm mt-1" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class = "fas fa-cog"></i>
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
                </div>';

                return $edit . $delete . $more;
            })
            ->addColumn('category', function ($query) {
                return $query->category->name;
            })
            ->addColumn('location', function ($query) {
                return $query->location->name;
            })
            ->addColumn('status', function ($query) {
                if ($query->status === 1) {
                    $status = "<span class='badge bg-success me-1'>Active</span>";
                } else {
                    $status = "";
                }

                if ($query->is_verified === 1) {
                    $featured = "<span class='badge bg-primary me-1'>Verified</span>";
                } else {
                    $featured = "";
                }

                if ($query->is_featured === 1) {
                    $verified =  "<span class='badge bg-info me-1'>Featured</span>";
                } else {
                    $verified =  "";
                }

                if ($query->is_approved === 0) {
                    $approved =  "<span class='badge bg-warning'>Pending</span>";
                } else {
                    $approved =  "";
                }
                return $status . $featured . $verified . $approved;
            })
            ->rawColumns(['status', 'action', 'is_verified', 'is_featured', 'image'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Listing $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('agentlisting-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('title'),
            Column::make('category'),
            Column::make('location'),
            Column::make('status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(150)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'AgentListing_' . date('YmdHis');
    }
}
