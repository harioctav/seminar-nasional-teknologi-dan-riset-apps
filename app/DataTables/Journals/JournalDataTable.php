<?php

namespace App\DataTables\Journals;

use App\Models\Journal;
use App\Helpers\Global\Constant;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use App\Services\Journal\JournalService;
use App\Services\User\UserService;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class JournalDataTable extends DataTable
{
  /**
   * Create a new datatable instance.
   *
   * @return void
   */
  public function __construct(
    protected UserService $userService,
    protected JournalService $journalService,
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
    $users = $this->userService->getReviewerOnly()->get();

    return (new EloquentDataTable($query))
      ->addIndexColumn()
      ->addColumn('user_name', function ($row) {
        return $row->user->name;
      })
      ->editColumn('status', fn ($row) => $row->isApproved())
      ->addColumn('select', function ($row) use ($users) {
        if ($row->selectReviewer) {
          return $row->selectReviewer->user->name;
        } else {
          return view('journals.journals.select-reviewer', compact('users', 'row'))->render();
        }
      })
      ->addColumn('action', 'journals.journals.action')
      ->rawColumns([
        'action',
        'status',
        'select',
      ]);
  }

  /**
   * Get the query source of dataTable.
   */
  public function query(Journal $model): QueryBuilder
  {
    return $this->journalService->sortByUserId();
  }

  /**
   * Optional method if you want to use the html builder.
   */
  public function html(): HtmlBuilder
  {
    return $this->builder()
      ->setTableId('journal-table')
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
      Column::make('excerpt')
        ->title(trans('Judul'))
        ->addClass('text-center'),
      Column::make('user_name')
        ->title(trans('Pemakalah'))
        ->addClass('text-center'),
      Column::make('upload_year')
        ->title(trans('Tahun Upload'))
        ->addClass('text-center'),
      Column::make('status')
        ->title(trans('Status'))
        ->addClass('text-center'),
      Column::make('select')
        ->title(trans('Reviewer'))
        ->visible(isRoleName() === Constant::ADMIN ? true : false)
        ->addClass('text-center'),
      Column::computed('action')
        ->exportable(false)
        ->printable(false)
        ->width('10%')
        ->addClass('text-center'),
    ];
  }

  /**
   * Get the filename for export.
   */
  protected function filename(): string
  {
    return 'Journal_' . date('YmdHis');
  }
}
