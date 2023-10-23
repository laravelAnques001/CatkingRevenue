{{--  <script src="{{ asset('assets/js/ion_rangeslider.min.js') }}"></script>  --}}
<script>
    $(document).ready(function() {
        var EchartsColumnsBasicLight = function() {
            var _columnsBasicLightExample = function() {
                if (typeof echarts == 'undefined') {
                    console.warn('Warning - echarts.min.js is not loaded.');
                    return;
                }

                // Define element
                var columns_basic_element = document.getElementById('columns_basic');

                if (columns_basic_element) {

                    // Initialize chart
                    var columns_basic = echarts.init(columns_basic_element, null, {
                        renderer: 'svg'
                    });

                    columns_basic.setOption({

                        // Define colors
                        color: ['#0280FC2E', '#328FEA'],
                        //color: ['rgba(var(--primary-rgb), 0.2)', 'rgba(var(--primary-rgb), 1)'],


                        // Global text styles
                        textStyle: {
                            fontFamily: 'var(--body-font-family)',
                            color: 'var(--body-color)',
                            fontSize: 14,
                            lineHeight: 22,
                            textBorderColor: 'transparent'
                        },

                        // Chart animation duration
                        animationDuration: 750,

                        // Setup grid
                        grid: {
                            left: 5,
                            right: 45,
                            top: 35,
                            bottom: 0,
                            containLabel: true
                        },

                        // Add legend
                        // legend: {
                        //     data: ['Evaporation', 'Precipitation'],
                        //     itemHeight: 8,
                        //     itemGap: 30,
                        //     textStyle: {
                        //         color: 'var(--body-color)',
                        //         padding: [0, 5]
                        //     }
                        // },

                        // Add tooltip
                        tooltip: {
                            trigger: 'axis',
                            className: 'shadow-sm rounded',
                            backgroundColor: 'var(--white)',
                            borderColor: 'var(--gray-400)',
                            padding: 15,
                            textStyle: {
                                color: '#000'
                            },
                            axisPointer: {
                                type: 'shadow',
                                shadowStyle: {
                                    color: 'rgba(var(--body-color-rgb), 0.025)'
                                }
                            }
                        },

                        // Horizontal axis
                        xAxis: [{
                            type: 'category',
                            data: ['CAT', 'Non-CAT', 'StudyAbroad', 'UnderGrad', 'GDPI',
                                'Mocks'
                            ],
                            axisLabel: {
                                color: 'rgba(var(--body-color-rgb), .65)'
                            },
                            axisLine: {
                                lineStyle: {
                                    color: 'var(--gray-500)'
                                }
                            },
                            splitLine: {
                                show: true,
                                lineStyle: {
                                    color: 'var(--gray-300)',
                                    type: 'dashed'
                                }
                            }
                        }],

                        // Vertical axis
                        yAxis: [{
                            type: 'value',
                            axisLabel: {
                                color: 'rgba(var(--body-color-rgb), .65)'
                            },
                            axisLine: {
                                show: true,
                                lineStyle: {
                                    color: 'var(--gray-500)'
                                }
                            },
                            splitLine: {
                                lineStyle: {
                                    color: 'var(--gray-300)'
                                }
                            },
                            splitArea: {
                                show: true,
                                areaStyle: {
                                    color: ['rgba(var(--white-rgb), .01)',
                                        'rgba(var(--black-rgb), .01)'
                                    ]
                                }
                            }
                        }],

                        // Add series
                        series: [{
                                name: 'Previous Day',
                                type: 'bar',
                                data: ["{{ $revenue['previous_day_total_revenue']['CAT'] }}",
                                    "{{ $revenue['previous_day_total_revenue']['GDPI'] }}",
                                    "{{ $revenue['previous_day_total_revenue']['Mocks'] }}",
                                    "{{ $revenue['previous_day_total_revenue']['Non-CAT'] }}",
                                    "{{ $revenue['previous_day_total_revenue']['Study Abroad'] }}",
                                    "{{ $revenue['previous_day_total_revenue']['UnderGrad'] }}",
                                ],

                                // data: [33, 59, 50, 30, 70, 85, 65, 87, 64, 33],
                                itemStyle: {
                                    normal: {
                                        barBorderRadius: [4, 4, 0, 0],
                                        label: {
                                            show: true,
                                            position: 'top',
                                            fontWeight: 500,
                                            fontSize: 12,
                                            color: 'var(--body-color)'
                                        }
                                    }
                                },
                                // markLine: {
                                //     data: [{
                                //         type: 'average',
                                //         name: 'Average'
                                //     }],
                                //     label: {
                                //         color: 'var(--body-color)'
                                //     }
                                // }
                            },
                            {
                                name: 'Today Day',
                                type: 'bar',
                                data: ["{{ $revenue['today_day_total_revenue']['CAT'] }}",
                                    "{{ $revenue['today_day_total_revenue']['GDPI'] }}",
                                    "{{ $revenue['today_day_total_revenue']['Mocks'] }}",
                                    "{{ $revenue['today_day_total_revenue']['Non-CAT'] }}",
                                    "{{ $revenue['today_day_total_revenue']['Study Abroad'] }}",
                                    "{{ $revenue['today_day_total_revenue']['UnderGrad'] }}"
                                ],
                                // data: [33, 59, 50, 30, 70, 85, 65, 87, 64, 33],
                                itemStyle: {
                                    normal: {
                                        barBorderRadius: [4, 4, 0, 0],
                                        label: {
                                            show: true,
                                            position: 'top',
                                            fontWeight: 500,
                                            fontSize: 12,
                                            color: 'var(--body-color)'
                                        }
                                    }
                                },
                                // markLine: {
                                //     data: [{
                                //         type: 'average',
                                //         name: 'Average'
                                //     }],
                                //     label: {
                                //         color: 'var(--body-color)'
                                //     }
                                // }
                            }
                        ]
                    });
                }


                //
                // Resize charts
                //

                // Resize function
                var triggerChartResize = function() {
                    columns_basic_element && columns_basic.resize();
                };

                // On sidebar width change
                var sidebarToggle = document.querySelectorAll('.sidebar-control');
                if (sidebarToggle) {
                    sidebarToggle.forEach(function(togglers) {
                        togglers.addEventListener('click', triggerChartResize);
                    });
                }

                // On window resize
                var resizeCharts;
                window.addEventListener('resize', function() {
                    clearTimeout(resizeCharts);
                    resizeCharts = setTimeout(function() {
                        triggerChartResize();
                    }, 200);
                });
            };

            return {
                init: function() {
                    _columnsBasicLightExample();
                }
            }
        }();

        var barsPiesExamples = function() {
            var _columnsBasicLightExample = function() {
                if (typeof c3 == 'undefined') {
                    console.warn('Warning - c3.min.js is not loaded.');
                    return;
                }

                // Define charts elements
                var donut_chart_element = document.getElementById('c3_donut_chart');
                // Donut chart
                if (donut_chart_element) {
                    // Generate chart
                    const donut_chart = c3.generate({
                        bindto: donut_chart_element,
                        size: {
                            width: 300
                        },
                        color: {
                            pattern: ['rgba(var(--enrollment-rgb), 1',
                                'rgba(var(--enrollment-rgb), 0.9',
                                'rgba(var(--enrollment-rgb), 0.8',
                                'rgba(var(--enrollment-rgb), 0.7',
                                'rgba(var(--enrollment-rgb), 0.6',
                                'rgba(var(--enrollment-rgb), 0.5'
                            ]
                        },
                        data: {
                            columns: [
                                ['CAT', 10],
                                ['Non-CAT', 10],
                                ['Study Abroad', 10],
                                ['UnderGrad', 10],
                                ['GDPI', 10],
                                ['Mocks', 10],
                            ],
                            type: 'donut'
                        },
                        donut: {
                            title: "Total Enrollment 100"
                        }
                    });

                    // Change data
                    setTimeout(function() {
                        donut_chart.load({
                            columns: [
                                ["CAT",
                                    "{{ $revenue['enrollment']['CAT'] }}"
                                ],
                                ["Non-CAT",
                                    "{{ $revenue['enrollment']['Non-CAT'] }}"
                                ],
                                ["Study Abroad",
                                    "{{ $revenue['enrollment']['Study Abroad'] }}"
                                ],
                                ["UnderGrad",
                                    "{{ $revenue['enrollment']['UnderGrad'] }}"
                                ],
                                ["GDPI",
                                    "{{ $revenue['enrollment']['GDPI'] }}"
                                ],
                                ["Mocks",
                                    "{{ $revenue['enrollment']['Mocks'] }}"
                                ],
                            ]
                        });
                    }, 1000);

                }
            };
            return {
                init: function() {
                    _columnsBasicLightExample();
                }
            }
        }();

        EchartsColumnsBasicLight.init();
        barsPiesExamples.init();

        $('[data-bs-popup="tooltip"]').tooltip();

        // Custom tooltip color
        // const _componentTooltipCustomColor = function() {
        //     const customTooltipElement = document.querySelector('[data-bs-popup=tooltip-custom]');
        //     if (customTooltipElement) {
        //         new bootstrap.Tooltip(customTooltipElement, {
        //             customClass: 'tooltip-custom',
        //             template: '< class="tooltip" role="tooltip"><div class="tooltip-arrow border-teal"></div><div class="tooltip-inner bg-teal text-white"><p>hello sir</p></div></// div>'
        //         });
        //     }
        // };
        // _componentTooltipCustomColor();

    });
</script>
{{--  @dd($revenue)  --}}
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header d-flex align-items-center border-0">
                <h5 class="fw-semibold mb-0">Enrollments</h5>
                <div class="ms-auto">
                    <div class="d-flex align-items-center text-muted fs-sm ">
                        <span class="bg-enrollment rounded-pill p-1 me-2"></span> This Year
                        <span class="bg-last-revenue rounded-pill p-1 mx-2"></span> Last Year
                    </div>
                </div>
            </div>
            <div class="card-body pt-0">
                <p class="mb-3">Total No Of Enrollment</p>
                <div class="progress mb-3" style="height: 0.625rem;">
                    <div class="progress-bar bg-enrollment"
                        style="width: {{ $revenue['this_year_total_enrollments_per'] }}%"
                        aria-valuenow="{{ $revenue['this_year_total_enrollments_per'] }}" aria-valuemin="0"
                        aria-valuemax="100" title="{{ $revenue['this_year_total_enrollments'] }}"
                        data-bs-popup="tooltip">
                    </div>
                </div>

                <div class="progress mb-3" style="height: 0.375rem;">
                    <div class="progress-bar bg-last-revenue"
                        style="width: {{ $revenue['last_year_total_enrollments_per'] }}%"
                        aria-valuenow="{{ $revenue['last_year_total_enrollments_per'] }}" aria-valuemin="0"
                        aria-valuemax="100" title="{{ $revenue['last_year_total_enrollments'] }}"
                        data-bs-popup="tooltip"></div>
                </div>

                <p class="mb-3">Enrollments Through installments & EMI </p>
                <div class="progress mb-3" style="height: 0.625rem;">
                    <div class="progress-bar bg-enrollment"
                        style="width: {{ $revenue['this_year_emi_enrollments_per'] }}%"
                        aria-valuenow="{{ $revenue['this_year_emi_enrollments_per'] }}" aria-valuemin="0"
                        aria-valuemax="100" title="{{ $revenue['this_year_emi_enrollments'] }}"
                        data-bs-popup="tooltip"></div>
                </div>
                <div class="progress mb-3" style="height: 0.375rem;">
                    <div class="progress-bar bg-last-revenue"
                        style="width: {{ $revenue['last_year_emi_enrollments_per'] }}%"
                        aria-valuenow="{{ $revenue['last_year_emi_enrollments_per'] }}" aria-valuemin="0"
                        aria-valuemax="100" title="{{ $revenue['last_year_emi_enrollments'] }}"
                        data-bs-popup="tooltip"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header d-flex align-items-center border-0">
                <h5 class="fw-semibold mb-0">Revenue</h5>
                <div class="ms-auto">
                    <div class="d-flex align-items-center text-muted fs-sm ">
                        <span class="bg-enrollment rounded-pill p-1 me-2"></span> This Year
                        <span class="bg-last-revenue rounded-pill p-1 mx-2"></span> Last Year
                    </div>
                </div>
            </div>
            <div class="card-body pt-0">
                <p class="mb-3">Total Revenue
                    @if ($revenue['total_revenue_per'] > 0)
                        <span class="text-success ms-2">{{ $revenue['total_revenue_per'] }}% <i
                                class="ph-trend-up me-2"></i></span>
                    @elseif($revenue['total_revenue_per'] < 0)
                        <span class="text-danger ms-2">{{ $revenue['total_revenue_per'] }}% <i
                                class="ph-trend-down me-2"></i></span>
                    @else
                        <span class="text-info ms-2">0.00%</span>
                    @endif
                </p>
                <div class="progress mb-3" style="height: 0.625rem;">
                    <div class="progress-bar bg-enrollment"
                        style="width: {{ $revenue['this_year_total_revenue_per'] }}%"
                        aria-valuenow="{{ $revenue['this_year_total_revenue_per'] }}" aria-valuemin="0"
                        aria-valuemax="100" title="{{ $revenue['this_year_total_revenue'] }}" data-bs-popup="tooltip">
                    </div>
                </div>
                <div class="progress mb-3" style="height: 0.375rem;">
                    <div class="progress-bar bg-last-revenue"
                        style="width: {{ $revenue['last_year_total_revenue_per'] }}%"
                        aria-valuenow="{{ $revenue['last_year_total_revenue_per'] }}" aria-valuemin="0"
                        aria-valuemax="100" title="{{ $revenue['last_year_total_revenue'] }}" data-bs-popup="tooltip">
                    </div>
                </div>

                <p class="mb-3">Revenue From Installments & EMI
                    @if ($revenue['total_emi_revenue_per'] > 0)
                        <span class="text-success ms-2">{{ $revenue['total_emi_revenue_per'] }}% <i
                                class="ph-trend-up me-2"></i></span>
                    @elseif($revenue['total_emi_revenue_per'] < 0)
                        <span class="text-danger ms-2">{{ $revenue['total_emi_revenue_per'] }}% <i
                                class="ph-trend-down me-2"></i></span>
                    @else
                        <span class="text-info ms-2">0.00% </span>
                    @endif
                </p>
                <div class="progress mb-3" style="height: 0.625rem;">
                    <div class="progress-bar bg-enrollment" style="width: {{ $revenue['this_year_emi_revenue_per'] }}%"
                        aria-valuenow="{{ $revenue['this_year_emi_revenue_per'] }}" aria-valuemin="0"
                        aria-valuemax="100" title="{{ $revenue['this_year_emi_revenue'] }}" data-bs-popup="tooltip">
                    </div>
                </div>
                <div class="progress mb-3" style="height: 0.375rem;">
                    <div class="progress-bar bg-last-revenue"
                        style="width: {{ $revenue['last_year_emi_revenue_per'] }}%"
                        aria-valuenow="{{ $revenue['last_year_emi_revenue_per'] }}" aria-valuemin="0"
                        aria-valuemax="100" title="{{ $revenue['last_year_emi_revenue'] }}" data-bs-popup="tooltip">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-6">
        <!-- Basic columns -->
        <div class="card">
            <div class="card-header d-flex align-items-center border-0">
                <h5 class="fw-semibold mb-0">Total No Of Enrollment </h5>
                <span class="ms-3 me-2 ">100</span>
                <span class="text-danger ">-12.01% <i class="ph-trend-down me-2"></i></span>
            </div>

            <div class="card-body pt-0">
                <div class="row">
                    <div class="col-md-6">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Courses Name</th>
                                        <th>Leads</th>
                                        <th>Enrollment</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        class="{{ $revenue['enrollment']['CAT'] == $revenue['enrollment']['maxValue'] && $revenue['enrollment']['CAT'] != 0 ? 'bg-enrollment-5' : '' }}">
                                        <td>
                                            <div class="d-flex align-items-center"><span
                                                    class="d-inline-block bg-enrollment rounded-pill p-1 me-1"></span>CAT
                                            </div>
                                        </td>
                                        <td>54</td>
                                        <td>{{ $revenue['enrollment']['CAT'] }}</td>
                                    </tr>
                                    <tr
                                        class="{{ $revenue['enrollment']['Non-CAT'] == $revenue['enrollment']['maxValue'] && $revenue['enrollment']['Non-CAT'] != 0 ? 'bg-enrollment-5' : '' }}">
                                        <td>
                                            <div class="d-flex align-items-center"><span
                                                    class="d-inline-block bg-enrollment-9 rounded-pill p-1 me-1"></span>NON-CAT
                                            </div>
                                        </td>
                                        <td>42</td>
                                        <td>{{ $revenue['enrollment']['Non-CAT'] }}</td>
                                    </tr>
                                    <tr
                                        class="{{ $revenue['enrollment']['Study Abroad'] == $revenue['enrollment']['maxValue'] && $revenue['enrollment']['Study Abroad'] != 0 ? 'bg-enrollment-5' : '' }}">
                                        <td>
                                            <div class="d-flex align-items-center"><span
                                                    class="d-inline-block bg-enrollment-8 rounded-pill p-1 me-1"></span>Study
                                                Abroad</div>
                                        </td>
                                        <td>36</td>
                                        <td>{{ $revenue['enrollment']['Study Abroad'] }}</td>
                                    </tr>
                                    <tr
                                        class="{{ $revenue['enrollment']['UnderGrad'] == $revenue['enrollment']['maxValue'] && $revenue['enrollment']['UnderGrad'] != 0 ? 'bg-enrollment-5' : '' }}">
                                        <td>
                                            <div class="d-flex align-items-center"><span
                                                    class="d-inline-block bg-enrollment-7 rounded-pill p-1 me-1"></span>UnderGrad
                                            </div>
                                        </td>
                                        <td>23</td>
                                        <td>{{ $revenue['enrollment']['UnderGrad'] }}</td>
                                    </tr>
                                    <tr
                                        class="{{ $revenue['enrollment']['GDPI'] == $revenue['enrollment']['maxValue'] && $revenue['enrollment']['GDPI'] != 0 ? 'bg-enrollment-5' : '' }}">
                                        <td><span
                                                class="d-inline-block bg-enrollment-6 rounded-pill p-1 me-1"></span>GDPI
                                        </td>
                                        <td>19</td>
                                        <td>{{ $revenue['enrollment']['GDPI'] }}</td>
                                    </tr>
                                    <tr
                                        class="{{ $revenue['enrollment']['Mocks'] == $revenue['enrollment']['maxValue'] && $revenue['enrollment']['Mocks'] != 0 ? 'bg-enrollment-5' : '' }}">
                                        <td><span
                                                class="d-inline-block bg-enrollment-5 rounded-pill p-1 me-1"></span>Mocks
                                        </td>
                                        <td>14</td>
                                        <td>{{ $revenue['enrollment']['Mocks'] }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="chart-container text-center overflow-auto ">
                            <div class="chart has-fixed-height" id="c3_donut_chart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /basic columns -->
    </div>
    <div class="col-xl-6">
        <!-- Basic columns -->
        <div class="card">
            <div class="card-header d-flex align-items-center border-0">
                <h5 class="fw-semibold mb-0">Total Revenue</h5>
                <span class="mx-2 ">{{ $revenue['total_revenue']['sum'] }}</span>
                @if ($revenue['total_revenue']['per'] > 0)
                    <span class="text-success ">
                        {{ $revenue['total_revenue']['per'] }}% <i class="ph-trend-up me-2"></i>
                    </span>
                @elseif($revenue['total_revenue']['per'] < 0)
                    <span class="text-danger ">
                        {{ $revenue['total_revenue']['per'] }}% <i class="ph-trend-down me-2"></i>
                    </span>
                @else
                    <span class="text-info ms-2">0.00% </span>
                @endif
                <div class="ms-auto ">
                    <div class="d-flex align-items-center text-muted fs-sm">
                        <span class="bg-primary rounded-pill p-1 me-1"></span> This Day
                        <span class="bg-primary-2 rounded-pill p-1 mx-1"></span> Previous Day
                    </div>
                </div>
            </div>

            <div class="card-body pt-0">
                <div class="chart-container">
                    <div class="chart has-fixed-height" id="columns_basic"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- /basic columns -->

    <div class="col-xl-6">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h5 class="fw-semibold mb-0">Failed Order</h5>
                <div class="ms-auto">
                    <i class="ph-info " data-bs-toggle="modal" data-bs-target="#modal_large" data-bs-popup="tooltip"
                        title="Failed Order"></i>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <tbody>
                        <tr>
                            <td>Failed Order With Successful Repeat Purchase </td>
                            <td>{{ $revenue['failed_order_repeat_purchase'] }}</td>
                        </tr>
                        <tr>
                            <td>Actual Failed Orders The Ones Who Did Not Purchase</td>
                            <td>{{ $revenue['failed_order_dont_purchase'] }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Large modal -->
<div id="modal_large" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Students List For Failed Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="table-responsive border-radius-15">
                <table class="table table-bordered table-framed">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Order Id</th>
                            <th>Name</th>
                            <th>Email Id</th>
                            <th>Phone Number</th>
                            <th>Course Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($revenue['failed_order_list'] as $key => $order)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>ID: {{ $order->order_id }}</td>
                                <td class="d-flex align-items-center">
                                    <img src="https://ui-avatars.com/api/?background=random&color=random&name={{ $order->name }}&size=512&rounded=true&format=svg"
                                        class="rounded-pill w-32px" alt="">
                                    <span class="ms-1">{{ $order->name }}</span>
                                </td>
                                <td>{{ $order->email }}</td>
                                <td>{{ $order->phone_number }}</td>
                                <td>{{ $order->course_name }}</td>
                            </tr>
                        @endforeach
                        {{--  <tr>
                            <td>1</td>
                            <td>ID: 43178</td>
                            <td class="d-flex align-items-center">
                                <img src="{{ asset('assets/images/placeholder.jpg') }}" class="rounded-pill w-32px"
                                    alt="">
                                <span class="ms-1">Abhijeet Kumar Shaw</span>
                            </td>
                            <td>abhijeetkumarshaw@user.com</td>
                            <td>+919355574544</td>
                            <td>IIM WAT PI</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>ID: 43178</td>
                            <td class="d-flex align-items-center">
                                <img src="{{ asset('assets/images/placeholder.jpg') }}" class="rounded-pill w-32px"
                                    alt="">
                                <span class="ms-1">Arjun Gnanasambandam</span>
                            </td>
                            <td>ArjunGnanasamban@user.com</td>
                            <td>+917555381084</td>
                            <td>CAT2024+GMAT</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>ID: 22739</td>
                            <td class="d-flex align-items-center">
                                <img src="{{ asset('assets/images/placeholder.jpg') }}" class="rounded-pill w-32px"
                                    alt="">
                                <span class="ms-1">Anuja Shinde</span>
                            </td>
                            <td>AnujaShinde@user.com</td>
                            <td>+917555486014</td>
                            <td>IELTS Intensive</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>ID: 97174</td>
                            <td class="d-flex align-items-center">
                                <img src="{{ asset('assets/images/placeholder.jpg') }}" class="rounded-pill w-32px"
                                    alt="">
                                <span class="ms-1">Babbi Khan</span>
                            </td>
                            <td>BabbiKhan@user.com</td>
                            <td>+917555681931</td>
                            <td>Intensive 2023</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>ID: 22739</td>
                            <td class="d-flex align-items-center">
                                <img src="{{ asset('assets/images/placeholder.jpg') }}" class="rounded-pill w-32px"
                                    alt="">
                                <span class="ms-1">Harchahat Singh Sandhu</span>
                            </td>
                            <td>HarchahatSingh@user.com</td>
                            <td>+918555382423</td>
                            <td>Turbo 2023</td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>ID: 39635</td>
                            <td class="d-flex align-items-center">
                                <img src="{{ asset('assets/images/placeholder.jpg') }}" class="rounded-pill w-32px"
                                    alt="">
                                <span class="ms-1">Kanishka Kapoor</span>
                            </td>
                            <td>KanishkaKapoor@user.com</td>
                            <td>+918555363120</td>
                            <td>CAT2024+GMAT</td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>ID: 39635</td>
                            <td class="d-flex align-items-center">
                                <img src="{{ asset('assets/images/placeholder.jpg') }}" class="rounded-pill w-32px"
                                    alt="">
                                <span class="ms-1">Karthik Vijayakumar Reddy</span>
                            </td>
                            <td>KarthikVijayakumar@user.com</td>
                            <td>+919855506795</td>
                            <td>IIM WAT PI</td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>ID: 70668</td>
                            <td class="d-flex align-items-center">
                                <img src="{{ asset('assets/images/placeholder.jpg') }}" class="rounded-pill w-32px"
                                    alt="">
                                <span class="ms-1">Saaquib Mohammad</span>
                            </td>
                            <td>SaaquibMohammad@user.com</td>
                            <td>+918555989279</td>
                            <td>Intensive 2023</td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>ID: 70668</td>
                            <td class="d-flex align-items-center">
                                <img src="{{ asset('assets/images/placeholder.jpg') }}" class="rounded-pill w-32px"
                                    alt="">
                                <span class="ms-1">Saaquib Mohammad</span>
                            </td>
                            <td>SaaquibMohammad@user.com</td>
                            <td>+918555989279</td>
                            <td>Intensive 2023</td>
                        </tr>
                        <tr>
                            <td>9</td>
                            <td>ID: 43756</td>
                            <td class="d-flex align-items-center">
                                <img src="{{ asset('assets/images/placeholder.jpg') }}" class="rounded-pill w-32px"
                                    alt="">
                                <span class="ms-1">Tyson Jayanth</span>
                            </td>
                            <td>TysonJayanth@user.com</td>
                            <td>+917555078586</td>
                            <td>IELTS Intensive</td>
                        </tr>
                        <tr>
                            <td>10</td>
                            <td>ID: 97174</td>
                            <td class="d-flex align-items-center">
                                <img src="{{ asset('assets/images/placeholder.jpg') }}" class="rounded-pill w-32px"
                                    alt="">
                                <span class="ms-1">Yamini Gowda</span>
                            </td>
                            <td>YaminiGowda@user.com</td>
                            <td>+919755523240</td>
                            <td>Intensive 2023</td>
                        </tr>  --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /large modal -->
