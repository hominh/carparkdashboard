<?php

namespace Carparkdashboard\Sensor\DataTables;


use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Carparkdashboard\Sensor\Repositories\Sensor\SensorRepositoryInterface;


class SensorDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */

    protected $sensor;
    public function __construct(SensorRepositoryInterface $sensor)
    {
        $this->sensor = $sensor;
    }

    public function ajax()
    {
        $data =  $this->sensor->getAll();

        return datatables()::of($data)
                 ->editColumn('checkbox', function ($item) {
                    return '<input type="checkbox" class="group-checkable" value="'.$item->id.'">';
                })
                 ->editColumn('name', function ($item) {
                    return '<a href="'.route('sensor.edit',$item->id).'">'.$item->name.'</a>';
                })

                ->editColumn('Operations', function ($item) {
                  //$permission = $this->authorize('view', $item);
                  return '<a href="'.route('sensor.edit',$item->id).'" class="btn btn-icon btn-primary" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit"></i></a><a href="#" class="btn btn-icon btn-danger deleteDialog" data-toggle="modal" data-target="#delete" catid="'.$item->id.'"><i class="fa fa-trash"></i></a>';
                })
                ->rawColumns(['checkbox','name','Operations'])
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
                    ->setTableId('listSensor')

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
                           'className' => 'btn btn-danger action-item deleteSensor',
                           'idName' => 'deleteSensor',
                            'action' => 'function(e, dt, node, config) {}'
                           ]
                        ],
                        'select' => [
                          'style' => 'multi'
                        ],
                        'language'     => [
                            'info' => view('carparkdashboard-sensor::table.table-info')->render(),
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

            Column::computed('id')
                ->title('ID')
            ,
            Column::make('name')->title('Tên'),
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
        return 'Sensors_' . date('YmdHis');
    }
}
