<?php

namespace App\DataTables\Journals;

use App\Models\Transaction;
use App\Helpers\Global\Helper;
use App\Helpers\Global\Constant;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\Services\Transaction\TransactionService;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class TransactionDataTable extends DataTable
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(
    protected TransactionService $transactionService,
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
      ->addColumn('user_name', fn ($row) => $row->user->name)
      ->editColumn('upload_date', fn ($row) => Helper::customDate($row->upload_date))
      ->addColumn('bank_name', fn ($row) => $row->payment->bank->name)
      ->editColumn('proof', 'journals.transactions.proof')
      ->editColumn('status', 'journals.transactions.status')
      ->addColumn('action', 'journals.transactions.action')
      ->rawColumns([
        'action',
        'proof',
        'status',
      ]);
  }

  /**
   * Get the query source of dataTable.
   */
  public function query(Transaction $model): QueryBuilder
  {
    return $this->transactionService->getDataByUserId();
  }

  /**
   * Optional method if you want to use the html builder.
   */
  public function html(): HtmlBuilder
  {
    return $this->builder()
      ->setTableId('transaction-table')
      ->columns($this->getColumns())
      ->ajax([
        'url' => route('transactions.index'),
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
      Column::make('user_name')
        ->title(trans('Pemakalah'))
        ->addClass('text-center'),
      Column::make('bank_name')
        ->title(trans('Transfer Via'))
        ->addClass('text-center'),
      Column::make('upload_date')
        ->title(trans('Tanggal Bayar'))
        ->addClass('text-center'),
      Column::make('proof')
        ->title(trans('Bukti'))
        ->addClass('text-center'),
      Column::make('status')
        ->title(trans('Status'))
        ->addClass('text-center'),
      Column::computed('action')
        // ->title('<i class="fa fa-cog"></i>')
        ->exportable(false)
        ->printable(false)
        ->width('15%')
        ->addClass('text-center'),
    ];
  }

  /**
   * Get the filename for export.
   */
  protected function filename(): string
  {
    return 'Transaction_' . date('YmdHis');
  }
}
