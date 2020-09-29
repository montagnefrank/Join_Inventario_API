<script class='controller'>
    setTimeout(function() {

        /*           ACTUALIZAR CONTADORES               */
        $(document).off('click', "#updateCharts");
        $(document).on('click', '#updateCharts', function(e) {
            var userIntel = JSON.parse(window.localStorage.getItem("userIntel")),
                panelToShow = userIntel.panelUsuario,
                userId = $('#sidebarLoaded').attr('userIdPanel');
            $("#loading").fadeIn("fast", function() {
                showPanel(panelToShow, userId);
            });
        });

        $('.anim').velocity("transition.slideUpBigIn", {
            stagger: 250,
            complete: function() {

            }
        });
    }, 1000);

    // CREAR ARREGLO DE FECHAS DIA POR DIA
    function getDateArray(type = 'normal') {
        // CREAMOS EL RANGO DE FECHAS QUE SE MOSTRARA EN EL GRAFICO
        var startDate = new Date("2019-11-11");
        var today = new Date(),
            dd = today.getDate() + 1,
            mm = today.getMonth() + 1,
            yyyy = today.getFullYear();
        if (dd < 10) {
            dd = '0' + dd;
        }
        if (mm < 10) {
            mm = '0' + mm;
        }
        today = yyyy + '-' + mm + '-' + dd;
        var endDate = new Date(today);

        var arr = new Array();
        var dt = new Date(startDate);
        while (dt <= endDate) {
            var thisday = new Date(dt),
                d = thisday.getDate() + 1,
                m = thisday.getMonth() + 1,
                y = thisday.getFullYear();
            if (d < 10) {
                d = '0' + d;
            }
            if (m < 10) {
                m = '0' + m;
            }
            if (m == 11) {
                if (d == 31) {
                    d = '01';
                    m = '12';
                }
            }
            if (m == 12) {
                if (d == 32) {
                    d = '01';
                    m = '01';
                }
            }
            if (type == 'normal') {
                thisday = m + '-' + d;
            } else {
                thisday = y + '-' + m + '-' + d;
            }
            arr.push(thisday);
            dt.setDate(dt.getDate() + 1);
        }

        return arr;
    }
</script>