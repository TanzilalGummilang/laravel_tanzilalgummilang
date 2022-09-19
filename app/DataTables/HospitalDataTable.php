<?php

namespace App\DataTables;

use App\Models\Hospital;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class HospitalDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addindexColumn()
            ->editColumn('created_at', fn ($row) => $row->created_at->format('d-m-Y H:i:s'))
            ->editColumn('updated_at', fn ($row) => $row->created_at->format('d-m-Y H:i:s'))
            ->addColumn('action', function ($row) {
                $action = '';
                $action = '<button data-id=' . $row->id . ' data-type="edit" class="btn btn-sm btn-warning action">Edit</button>';
                $action .= ' <button data-id=' . $row->id . ' data-type="delete" class="btn btn-sm btn-danger action">Delete</button>';
                return $action;
            })
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Hospital $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Hospital $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('hospital-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->responsive(true)
            ->autoWidth(false);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')->title('No')->searchable(false)->orderable(false),
            Column::make('name'),
            Column::make('address'),
            Column::make('email'),
            Column::make('phone'),
            Column::make('created_at'),
            Column::make('updated_at'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(110)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Hospital_' . date('YmdHis');
    }
}
