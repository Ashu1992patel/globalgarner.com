<!-- jQuery CDN - Slim version (=without AJAX) -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $(function() {
            $('.listblock').on('hidden.bs.collapse', function() {
                $('.tooglenav a .dov').html('<span class="glyphicon glyphicon-collapse-down"></span>');
            })
            $('.listblock').on('show.bs.collapse', function() {
                $('.tooglenav a .dov').html('<span class="glyphicon glyphicon-collapse-up"></span>');
            })
        })

        $('ul.sidelist li').click(function() {
            $('ul.sidelist li   ').removeClass("active");
            $(this).addClass("active");
        });

        $('.menu-icon').click(function() {
            $('#sidebar').addClass("ml-0");
            $('.overlaybg').addClass("d-block");

        });

        $('#overlay').click(function() {
            $('#sidebar').removeClass("ml-0");
            $('.overlaybg').removeClass("d-block");

        });

    });
</script>

<script>
    $(document).ready(function() {
        $("#productInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myProducts div").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>