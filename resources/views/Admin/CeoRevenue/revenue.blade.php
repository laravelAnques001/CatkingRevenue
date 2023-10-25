@php
    $courseArr = json_encode($revenue['course_name']);
    $todayRevenue = json_encode($revenue['today_revenue']);
    $previousDayRevenue = json_encode($revenue['previous_day_revenue']);
@endphp

<script>
    $(document).ready(function() {
        const courseArr = <?= $courseArr ?>;
        const todayRevenue = <?= $todayRevenue ?>;
        const previousDayRevenue = <?= $previousDayRevenue ?>;

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
                            },
                            formatter: function(params) {
                                var tooltip = '' + params[0]
                                    .name;
                                var oldValue = params[0].value > 0 ? params[0].value : 1;
                                var per = (params[1].value - oldValue) / oldValue *
                                    100;
                                var percantage = params[0].value != 0 ? per.toFixed(2) : (
                                    params[1].value != 0 ? 100 : 0);
                                tooltip += percantage > 0 ?
                                    '<span class="text-success ms-2">' + percantage +
                                    '% <i class="ph-trend-up me-2"></i></span>' : (
                                        percantage < 0 ? '<span class="text-danger ms-2">' +
                                        percantage +
                                        '% <i class="ph-trend-down me-2"></i></span>' :
                                        '<span class="text-info ms-2">' +
                                        percantage +
                                        '% </span>');
                                tooltip +=
                                    '</p><p class="d-flex align-items-center text-muted fs-sm"><span class="bg-primary-2 align-items-center rounded-pill p-1 me-1"></span>Last Day<span class="ms-3"><b>' +
                                    params[0].value.toLocaleString('en-US', {
                                        style: 'decimal'
                                    }) + '</b></span></p>';
                                tooltip +=
                                    '<p class="d-flex align-items-center text-muted fs-sm"><span class="bg-primary align-items-center rounded-pill p-1 me-1"></span>Today<span class="ms-4 ps-1"><b>' +
                                    params[1].value.toLocaleString('en-US', {
                                        style: 'decimal'
                                    }) + '</b></span></p>';
                                return tooltip;
                            }
                        },

                        // Horizontal axis
                        xAxis: [{
                            type: 'category',
                            data: courseArr,
                            axisLabel: {
                                color: 'rgba(var(--body-color-rgb), .65)',
                                rotate: 30
                            },
                            axisLine: {
                                lineStyle: {
                                    color: 'var(--gray-500)',
                                },
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
                                color: 'rgba(var(--body-color-rgb), .65)',
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
                                data: previousDayRevenue,
                                itemStyle: {
                                    normal: {
                                        barBorderRadius: [4, 4, 0, 0],
                                        label: {
                                            show: true,
                                            distance: -5,
                                            rotate: 90,
                                            bottom: 15,
                                            align: 'left',
                                            verticalAlign: 'middle',
                                            position: 'bottom',
                                            fontWeight: 500,
                                            fontSize: 12,
                                            color: 'var(--body-color)',
                                            formatter: function(d) {
                                                return d.data.toLocaleString('en-US', {
                                                    style: 'decimal'
                                                });
                                            }
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
                                data: todayRevenue,
                                itemStyle: {
                                    normal: {
                                        barBorderRadius: [4, 4, 0, 0],
                                        label: {
                                            show: true,
                                            distance: -5,
                                            rotate: 90,
                                            bottom: 15,
                                            align: 'left',
                                            verticalAlign: 'middle',
                                            position: 'bottom',
                                            fontWeight: 500,
                                            fontSize: 12,
                                            color: 'var(--body-color)',
                                            formatter: function(d) {
                                                return d.data.toLocaleString('en-US', {
                                                    style: 'decimal'
                                                });
                                            }
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
                                ['CAT', "{{ $revenue['enrollment_per']['cat'] }}"],
                                ['Non-CAT', "{{ $revenue['enrollment_per']['non-cat'] }}"],
                                ['Study Abroad',
                                    "{{ $revenue['enrollment_per']['study-abroad'] }}"
                                ],
                                ['UnderGrad',
                                    "{{ $revenue['enrollment_per']['undergrad'] }}"
                                ],
                                ['GDPI', "{{ $revenue['enrollment_per']['gdpi'] }}"],
                                ['Mocks', "{{ $revenue['enrollment_per']['mocks'] }}"],
                            ],
                            type: 'donut'
                        },
                        donut: {
                            title: "Total Enrollment 100"
                        }
                    });

                    // Change data
                    {{--  setTimeout(function() {
                        donut_chart.load({
                            columns: [
                                ["CAT",
                                    "{{ $revenue['enrollment']['cat'] }}"
                                ],
                                ["Non-CAT",
                                    "{{ $revenue['enrollment']['non-cat'] }}"
                                ],
                                ["Study Abroad",
                                    "{{ $revenue['enrollment']['study-abroad'] }}"
                                ],
                                ["UnderGrad",
                                    "{{ $revenue['enrollment']['undergrad'] }}"
                                ],
                                ["GDPI",
                                    "{{ $revenue['enrollment']['gdpi'] }}"
                                ],
                                ["Mocks",
                                    "{{ $revenue['enrollment']['mocks'] }}"
                                ],
                            ]
                        });
                    }, 1000);  --}}

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
                <p class="mb-3">Total no of enrollment</p>
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

                <p class="mb-3">Enrollments through installments & EMI </p>
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
                <p class="mb-3">Total revenue
                    @if ($revenue['total_revenue_per'] > 0)
                        <span class="text-success ms-2">{{ $revenue['total_revenue_per'] }}% <i
                                class="ph-trend-up me-2"></i></span>
                    @elseif($revenue['total_revenue_per'] < 0)
                        <span class="text-danger ms-2">{{ $revenue['total_revenue_per'] }}% <i
                                class="ph-trend-down me-2"></i></span>
                        {{--  @else
                        <span class="text-info ms-2">0.00%</span>  --}}
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

                <p class="mb-3">Revenue from installments & EMI
                    @if ($revenue['total_emi_revenue_per'] > 0)
                        <span class="text-success ms-2">{{ $revenue['total_emi_revenue_per'] }}% <i
                                class="ph-trend-up me-2"></i></span>
                    @elseif($revenue['total_emi_revenue_per'] < 0)
                        <span class="text-danger ms-2">{{ $revenue['total_emi_revenue_per'] }}% <i
                                class="ph-trend-down me-2"></i></span>
                        {{--  @else
                        <span class="text-info ms-2">0.00% </span>  --}}
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
                <h5 class="fw-semibold mb-0">Total no of enrollment </h5>
                {{--  <span class="ms-3 me-2 ">100</span>  --}}
                @if ($revenue['enrollment_per_avg'] > 0)
                    <span class="text-success ms-2">{{ $revenue['enrollment_per_avg'] }}% <i
                            class="ph-trend-up me-2"></i></span>
                @elseif($revenue['enrollment_per_avg'] < 0)
                    <span class="text-danger ms-2">{{ $revenue['enrollment_per_avg'] }}% <i
                            class="ph-trend-down me-2"></i></span>
                    {{--  @else
                    <span class="text-info ms-2">0.00% </span>  --}}
                @endif
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
                                        class="{{ $revenue['enrollment_per']['cat'] == $revenue['enrollment_max'] && $revenue['enrollment_per']['cat'] != 0 ? 'bg-enrollment-5' : '' }}">
                                        <td>
                                            <div class="d-flex align-items-center"><span
                                                    class="d-inline-block bg-enrollment rounded-pill p-1 me-1"></span>CAT
                                            </div>
                                        </td>
                                        <td>{{ $revenue['leads']['cat'] }}</td>
                                        <td>{{ $revenue['enrollment_per']['cat'] }}</td>
                                    </tr>
                                    <tr
                                        class="{{ $revenue['enrollment_per']['non-cat'] == $revenue['enrollment_max'] && $revenue['enrollment_per']['non-cat'] != 0 ? 'bg-enrollment-5' : '' }}">
                                        <td>
                                            <div class="d-flex align-items-center"><span
                                                    class="d-inline-block bg-enrollment-9 rounded-pill p-1 me-1"></span>NON-CAT
                                            </div>
                                        </td>
                                        <td>{{ $revenue['leads']['non-cat'] }}</td>
                                        <td>{{ $revenue['enrollment_per']['non-cat'] }}</td>
                                    </tr>
                                    <tr
                                        class="{{ $revenue['enrollment_per']['study-abroad'] == $revenue['enrollment_max'] && $revenue['enrollment_per']['study-abroad'] != 0 ? 'bg-enrollment-5' : '' }}">
                                        <td>
                                            <div class="d-flex align-items-center"><span
                                                    class="d-inline-block bg-enrollment-8 rounded-pill p-1 me-1"></span>Study
                                                Abroad</div>
                                        </td>
                                        <td>{{ $revenue['leads']['study-abroad'] }}</td>
                                        <td>{{ $revenue['enrollment_per']['study-abroad'] }}</td>
                                    </tr>
                                    <tr
                                        class="{{ $revenue['enrollment_per']['undergrad'] == $revenue['enrollment_max'] && $revenue['enrollment_per']['undergrad'] != 0 ? 'bg-enrollment-5' : '' }}">
                                        <td>
                                            <div class="d-flex align-items-center"><span
                                                    class="d-inline-block bg-enrollment-7 rounded-pill p-1 me-1"></span>UnderGrad
                                            </div>
                                        </td>
                                        <td>{{ $revenue['leads']['undergrad'] }}</td>
                                        <td>{{ $revenue['enrollment_per']['undergrad'] }}</td>
                                    </tr>
                                    <tr
                                        class="{{ $revenue['enrollment_per']['gdpi'] == $revenue['enrollment_max'] && $revenue['enrollment_per']['gdpi'] != 0 ? 'bg-enrollment-5' : '' }}">
                                        <td><span
                                                class="d-inline-block bg-enrollment-6 rounded-pill p-1 me-1"></span>GDPI
                                        </td>
                                        <td>{{ $revenue['leads']['gdpi'] }}</td>
                                        <td>{{ $revenue['enrollment_per']['gdpi'] }}</td>
                                    </tr>
                                    <tr
                                        class="{{ $revenue['enrollment_per']['mocks'] == $revenue['enrollment_max'] && $revenue['enrollment_per']['mocks'] != 0 ? 'bg-enrollment-5' : '' }}">
                                        <td><span
                                                class="d-inline-block bg-enrollment-5 rounded-pill p-1 me-1"></span>Mocks
                                        </td>
                                        <td>{{ $revenue['leads']['mocks'] }}</td>
                                        <td>{{ $revenue['enrollment_per']['mocks'] }}</td>
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
                <h5 class="fw-semibold mb-0">Total revenue</h5>
                @if ($revenue['total_today_revenue'] != 0)
                    <span class="mx-2 bg-primary-2 roundedp-1">{{ $revenue['total_today_revenue'] }}</span>
                @endif
                @if ($revenue['total_per_revenue'] > 0)
                    <span class="text-success ">
                        {{ $revenue['total_per_revenue'] }}% <i class="ph-trend-up me-2"></i>
                    </span>
                @elseif($revenue['total_per_revenue'] < 0)
                    <span class="text-danger ">
                        {{ $revenue['total_per_revenue'] }}% <i class="ph-trend-down me-2"></i>
                    </span>
                    {{--  @else
                    <span class="text-info ms-2">0.00% </span>  --}}
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
                <h5 class="fw-semibold mb-0">Failed order</h5>
                <div class="ms-auto">
                    {{--  <i class="ph-info " data-bs-toggle="modal" data-bs-target="#modal_large" data-bs-popup="tooltip"
                        title="Failed Order"></i>  --}}
                    <a href="{{ route('ceo-revenue-model') }}" class="ajaxviewmodel">
                        <i class="ph-info" data-bs-popup="tooltip" title="Failed Order"></i>
                    </a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <tbody>
                        <tr>
                            <td>Failed order with successful repeat purchase </td>
                            <td>{{ $revenue['failed_order_repeat_purchase'] }}</td>
                        </tr>
                        <tr>
                            <td>Actual failed orders the ones who did not purchase</td>
                            <td>{{ $revenue['failed_order_dont_purchase'] }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

