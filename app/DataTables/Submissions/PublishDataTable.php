<?php

namespace App\DataTables\Submissions;

use App\Helpers\Global\Constant;
use App\Helpers\Global\Helper;
use App\Models\Publish;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PublishDataTable extends DataTable
{
  /**
   * Build the DataTable class.
   *
   * @param QueryBuilder $query Results from query() method.
   */
  public function dataTable(QueryBuilder $query): EloquentDataTable
  {
    return (new EloquentDataTable($query))
      ->addIndexColumn()
      ->editColumn('publish_date', fn ($row) => Helper::customDate($row->publish_date))
      ->editColumn('is_active', fn ($row) => $row->isActive())
      ->addColumn('user_has_journal', fn ($row) => $row->journal->user->name)
      ->addColumn('journal_excerpt', fn ($row) => $row->journal->excerpt)
      ->addColumn('journal_status', fn ($row) => $row->journal->isApproved())
      ->addColumn('action', 'publishes.action')
      ->rawColumns([
        'action',
        'is_active',
        'journal_status',
      ]);
  }

  /**
   * Get the query source of dataTable.
   */
  public function query(Publish $model): QueryBuilder
  {
    return $model->newQuery();
  }

  /**
   * Optional method if you want to use the html builder.
   */
  public function html(): HtmlBuilder
  {
    return $this->builder()
      ->setTableId('publish-table')
      ->columns($this->getColumns())
      // ->minifiedAjax()
      //->dom('Bfrtip')
      // ->orderBy(1)
      // ->selectStyleSingle()
      // ->buttons([
      //   Button::make('excel'),
      //   Button::make('csv'),
      //   Button::make('pdf'),
      //   Button::make('print'),
      //   Button::make('reset'),
      //   Button::make('reload')
      // ]);
      ->addTableClass([
        'table',
        'table-striped',
        'table-bordered',
        'table-hover',
        'table-vcenter',
      ])
      ->processing(true)
      ->retrieve(true)
      ->serverSide(true)
      ->autoWidth(false)
      ->pageLength(5)
      ->responsive(true)
      ->lengthMenu([5, 10, 20])
      ->orderBy(1);
  }

  /**
   * Get the dataTable columns definition.
   */
  public function getColumns(): array
  {
    return [
      Column::make('DT_RowIndex')
        ->title(trans('#'))
        ->orderable(false)
        ->searchable(false)
        ->width('5%')
        ->addClass('text-center'),

      Column::make('journal_excerpt')
        ->title(trans('Judul'))
        ->addClass('text-center'),

      Column::make('user_has_journal')
        ->title(trans('Pemakalah'))
        ->addClass('text-center'),

      Column::make('publish_date')
        ->title(trans('Tanggal Publish'))
        ->addClass('text-center'),

      Column::make('is_active')
        ->title(trans('Status'))
        ->addClass('text-center'),

      Column::make('journal_status')
        ->title(trans('Status Jurnal'))
        ->addClass('text-center'),

      Column::make('action')
        ->title(trans('Download'))
        ->visible(isRoleName() === Constant::ADMIN ? true : false)
        ->width('5%')
        ->addClass('text-center'),
    ];
  }

  /**
   * Get the filename for export.
   */
  protected function filename(): string
  {
    return 'Publish_' . date('YmdHis');
  }
}
