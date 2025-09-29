import './bootstrap';
import * as echarts from 'echarts';

document.addEventListener("DOMContentLoaded", () => {
    const el = document.getElementById("graficoVendas");
    if (!el || !window.dashboardData) return;

    const chart = echarts.init(el);

    const option = {
        title: { text: 'Vendas Mensais' },
        tooltip: {},
        xAxis: { data: window.dashboardData.meses },
        yAxis: {},
        series: [
            {
                name: 'Vendas',
                type: 'bar',
                data: window.dashboardData.valores,
            }
        ]
    };

    chart.setOption(option);
    window.addEventListener("resize", () => chart.resize());
});
