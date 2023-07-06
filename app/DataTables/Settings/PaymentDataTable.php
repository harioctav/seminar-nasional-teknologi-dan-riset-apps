<?php

namespace App\DataTables\Settings;

use App\Models\Payment;
use App\Helpers\Global\Constant;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class PaymentDataTable extends DataTable
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
      ->editColumn('status', function ($row) {
        return $row->isStatus();
      })
      ->addColumn('bank_name', fn ($row) => $row->bank->name)
      ->addColumn('bank_code', fn ($row) => str_pad($row->bank->code, 3, '0', STR_PAD_LEFT))
      ->addColumn('edit_status', 'settings.payments.status')
      ->addColumn('action', 'settings.payments.action')
      ->rawColumns([
        'status',
        'action',
        'roles',
        'edit_status',
      ]);
  }

  /**
   * Get the query source of dataTable.
   */
  public function query(Payment $model): QueryBuilder
  {
    return $model->newQuery();
  }

  /**
   * Optional method if you want to use the html builder.
   */
  public function html(): HtmlBuilder
  {
    return $this->builder()
      ->setTableId('payment-table')
      ->columns($this->getColumns())
      ->ajax([
        'url' => route('payments.index'),
        'type' => 'GET',
        'data' => "
          function(data) {
            _token = '{{ csrf_token() }}',
            data.status = $('select[name=status]').val();
          }"
      ])
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
    $visibility = isRoleName() === Constant::ADMIN ? true : false;

    return [
      Column::make('DT_RowIndex')
        ->title(trans('#'))
        ->orderable(false)
        ->searchable(false)
        ->width('10%')
        ->addClass('text-center'),
      Column::make('bank_code')
        ->title(trans('Kode Bank'))
        ->addClass('text-center'),
      Column::make('bank_name')
        ->title(trans('Nama Bank'))
        ->addClass('text-center'),
      Column::make('number')
        ->title(trans('No. Rekening'))
        ->addClass('text-center'),
      Column::make('holder_name')
        ->title(trans('Pemegang Rekening'))
        ->addClass('text-center'),
      Column::make('status')
        ->title(trans('Status'))
        ->addClass('text-center'),
      Column::make('edit_status')
        ->title(trans('Ubah Status'))
        ->visible($visibility)
        ->addClass('text-center'),
      Column::computed('action')
        ->exportable(false)
        ->printable(false)
        ->width('5%')
        ->addClass('text-center'),
    ];
  }

  /**
   * Get the filename for export.
   */
  protected function filename(): string
  {
    return 'Payment_' . date('YmdHis');
  }
}
