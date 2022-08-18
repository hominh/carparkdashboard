<?php

namespace Carparkdashboard\Lot\DataTables;


use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Carparkdashboard\Lot\Repositories\Lot\LotRepositoryInterface;

class LotDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */

    protected $lot;
    public function __construct(LotRepositoryInterface $lot)
    {
        $this->lot = $lot;
    }

    public function ajax()
    {
        /*$value = Cache::remember('lots_cached',5, function () {
            $data = $this->lot->getAll();
            return $data;
        });
        $data = Cache::get('lots_cached');*/
        $data =  $this->lot->getAll();

        return datatables()::of($data)
                ->editColumn('checkbox', function ($item) {
                    return '<input type="checkbox" class="group-checkable" value="'.$item->id.'">';
                })
                ->editColumn('name', function ($item) {
                    return '<a href="'.route('lot.edit',$item->id).'">'.$item->name.'</a>';
                })
                ->editColumn('basement', function ($item) {
                    if(isset($item->basement[0]->id))
                      return '<a href="'.route('basement.edit',$item->basement[0]->id).'">'.$item->basement[0]->name.'</a>';
                })
                ->editColumn('camera', function ($item) {
                    if(isset($item->camera[0]->id))
                      return '<a href="'.route('camera.edit',$item->camera[0]->id).'">'.$item->camera[0]->name.'</a>';
                })
                 ->editColumn('sensor', function ($item) {
                    if(isset($item->sensor[0]->id))
                      return '<a href="'.route('sensor.edit',$item->sensor[0]->id).'">'.$item->sensor[0]->name.'</a>';
                })
                ->editColumn('overlap', function ($item) {
                    return $item->overlap."%";
                })
                ->editColumn('status', function ($item) {
                    if($item->status == 2)
                      return '<span class="label-warning status-label">Khởi tạo</span>';
                    if($item->status == 1)
                      return '<span class="label-danger status-label">Có xe</span>';
                    if($item->status == 0)
                      return '<span class="label-success status-label">Không có xe</span>';
                })
                ->editColumn('Operations', function ($item) {
                  //$permission = $this->authorize('view', $item);
                  return '<a href="'.route('lot.edit',$item->id).'" class="btn btn-icon btn-primary" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit"></i></a><a href="#" class="btn btn-icon btn-danger deleteDialog" data-toggle="modal" data-target="#delete" catid="'.$item->id.'"><i class="fa fa-trash"></i></a>';
                })
                ->rawColumns(['checkbox','name','basement','camera','sensor','overlap','status','Operations'])
                ->make(true);
    }



    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('listLot')

                    ->columns($this->getColumns(),[
                      'checkbox' => [
                        'orderable' => false,
                        'searchable' => false,
                        'printable' => false,
                        'exportable' => false,
                            'class'=>'msg',
                      ]
                    ])
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->parameters([
                        'buttons' => [
                            ['extend' => 'create','className' => 'btn btn-success action-item','text' => 'Thêm mới'],
                            ['extend' => 'reload', 'className' => 'btn btn-primary action-item','text' => 'Cập nhật dữ liệu'],
                            ['text' => '<i class="fa fa-fw fa-trash-o"></i> Xóa',
                           'className' => 'btn btn-danger action-item deleteLot',
                           'idName' => 'deleteLot',
                            'action' => 'function(e, dt, node, config) {}'
                           ]
                        ],
                        'select' => [
                          'style' => 'multi'
                        ],
                        'language'     => [
                            'info' => view('carparkdashboard-lot::table.table-info')->render(),
                            'search' => '',
                            "searchPlaceholder" => "Tìm kiếm...",
                            'paginate' => [
                                'previous' => 'Trang trước',
                                'next'     =>  'Trang sau'
                            ]
                        ],
                        'bStateSave'   => true,
                        'paging'       => true,
                        'searching'    => true,
                        'info'         => true,
                        'searchDelay'  => 350,
                        'processing'   => true,
                        'serverSide'   => true,
                        'bServerSide'  => true,
                        'bDeferRender' => true,
                        'bProcessing'  => true,
                    ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::computed('checkbox')->title('')->class('msg')->orderable(false),

            Column::computed('id_forS')
                ->title('ID')
            ,
            Column::make('name')->title('Tên'),
            Column::make('basement')->title('Bãi giữ xe'),
            Column::make('camera'),
            Column::make('sensor')->title('Cảm biến'),
            Column::make('overlap'),
            Column::make('status')->title('Trạng thái'),
            Column::computed('Operations')
                  ->exportable(false)
                  ->printable(false)
                  ->title('Thao tác')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Lots_' . date('YmdHis');
    }
}
