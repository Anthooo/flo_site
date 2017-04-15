$(document).ready(function() {

    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox();
    });

// init Isotope
    var $grid = $('.grid').imagesLoaded( function() {
        $('.grid').isotope({
            itemSelector: '.grid-item',
            transitionDuration: '0.5s',
            layoutMode: 'masonry'
        });
    });

    var $gridactu = $('.grid_actu').imagesLoaded( function() {
        $('.grid_actu').isotope({
            itemSelector: '.grid-item',
            transitionDuration: '0.5s',
            layoutMode: 'masonry'
        });
    });

    var $gridcours = $('.grid_cours').imagesLoaded( function() {
        $('.grid_cours').isotope({
            itemSelector: '.grid-item',
            transitionDuration: '0.5s',
            layoutMode: 'masonry',
            sortBy : 'random'
        });
    });

// filter functions
    var filterFns = {

    };
// bind filter button click
    $('.filters-button-group').on( 'click', 'button', function() {
        var filterValue = $( this ).attr('data-filter');
        // use filterFn if matches value
        filterValue = filterFns[ filterValue ] || filterValue;
        $grid.isotope({ filter: filterValue });
        $gridcours.isotope({ filter: filterValue });
        $gridactu.isotope({ filter: filterValue });


        if ($( this).attr('data-filter') === "#Adultes") {
            $('#coursadultes').removeClass('hidden');
            $('#coursados').addClass('hidden');
            $('#coursenfants').addClass('hidden');
            $('#stages').addClass('hidden');
        }
        else if ($( this).attr('data-filter') === "#Enfants") {
            $('#coursenfants').removeClass('hidden');
            $('#coursados').addClass('hidden');
            $('#coursadultes').addClass('hidden');
            $('#stages').addClass('hidden');

        }
        else if ($( this).attr('data-filter') === "#Ados") {
            $('#coursados').removeClass('hidden');
            $('#coursenfants').addClass('hidden');
            $('#coursadultes').addClass('hidden');
            $('#stages').addClass('hidden');

        }
        else if ($( this).attr('data-filter') === "#Stages") {
            $('#stages').removeClass('hidden');
            $('#coursados').addClass('hidden');
            $('#coursenfants').addClass('hidden');
            $('#coursadultes').addClass('hidden');

        }
        else if ($( this).attr('data-filter') === "*") {
            $('#stages').addClass('hidden');
            $('#coursados').addClass('hidden');
            $('#coursenfants').addClass('hidden');
            $('#coursadultes').addClass('hidden')
        }
        else {}

    });
// change is-checked class on buttons
    $('.button-group').each( function( i, buttonGroup ) {
        var $buttonGroup = $( buttonGroup );
        $buttonGroup.on( 'click', 'button', function() {
            $buttonGroup.find('.is-checked').removeClass('is-checked');
            $( this ).addClass('is-checked');

        });
    });

// JS Datatable
    $(document).ready(function() {


        $('#modeles').DataTable({
            "pageLength": 10,
            "responsive": true,
            "scrollX": true,
            "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
            "language": {
                "lengthMenu": "_MENU_ ",
                "zeroRecords": "Rien ne correspond à votre recherche désolé",
                "info": "Page _PAGE_ / _PAGES_",
                "search": "Rechercher:",
                "infoFiltered":   "(parmi _MAX_ modèles)",
                "paginate": {
                    "first":      "Premier",
                    "last":       "Dernier",
                    "next":       "Suivant",
                    "previous":   "Précédent"
                }
            }}
        )


    } );

// Modal Actualités
    $('#myModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var recipient = button.data('whatever'); // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this);
        modal.find('.modal-title').text('New message to ' + recipient);
        modal.find('.modal-body input').val(recipient)
    });

// Changement icône menu au clic
    $("#nav_icon").parent().on("click","#nav_icon", function () {
        $("#nav_icon").removeClass("glyphicon-menu-hamburger").addClass("glyphicon-chevron-right");
        $("#nav_icon").attr("id", "nav_icon2");
    });
    $("#nav_icon").parent().on("click","#nav_icon2",function () {
        $("#nav_icon2").removeClass("glyphicon-chevron-right").addClass("glyphicon-menu-hamburger");
        $("#nav_icon2").attr("id", "nav_icon");
    })});

