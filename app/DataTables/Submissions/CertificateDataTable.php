<?php

namespace App\DataTables\Submissions;

use App\Models\Certificate;
use App\Helpers\Global\Helper;
use App\Helpers\Global\Constant;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\Services\Certificate\CertificateService;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class CertificateDataTable extends DataTable
{
  /**
   * Create a new datatable instance.
   *
   * @return void
   */
  public function __construct(
    protected CertificateService $certificateService,
  ) {
    # code...
  }

  /**
   * Build the DataTable class.
   *
   * @param QueryBuilder $query Results from query() method.
   */
  public function dataTable(QueryBuilder $query): EloquentDataTable
  {
    return (new EloquentDataTable($query))
      ->addIndexColumn()
      ->addColumn('user', fn ($row) => $row->user->name)
      ->editColumn('generate_date', fn ($row) => Helper::customDate($row->generate_date))
      ->editColumn('image', 'certificates.action')
      ->addColumn('action', 'certificates.action')
      ->rawColumns([
        'action',
        'image',
      ]);
  }

  /**
   * Get the query source of dataTable.
   */
  public function query(Certificate $model): QueryBuilder
  {
    if (isRoleName() == Constant::PEMAKALAH) :
      return $this->certificateService->getDataByUserId(me()->id)->newQuery();
    else :
      return $model->newQuery();
    endif;
  }

  /**
   * Optional method if you want to use the html builder.
   */
  public function html(): HtmlBuilder
  {
    return $this->builder()
      ->setTableId('certificate-table')
      ->columns($this->getColumns())
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

      Column::make('user')
        ->title(trans('Nama'))
        ->addClass('text-center'),

      Column::make('code')
        ->title(trans('Kode'))
        ->addClass('text-center'),

      Column::make('generate_date')
        ->title(trans('Tanggal Generate'))
        ->addClass('text-center'),

      Column::make('action')
        ->title(trans('Download'))
        ->width('5%')
        ->addClass('text-center'),
    ];
  }

  /**
   * Get the filename for export.
   */
  protected function filename(): string
  {
    return 'Certificate_' . date('YmdHis');
  }
}
