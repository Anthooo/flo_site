$(document).on('click', '[data-toggle="lightbox"]', function(event) {
    event.preventDefault();
    $(this).ekkoLightbox();
});

// init Isotope
var $grid = $('.grid').isotope({
    itemSelector: '.grid-item',
    layoutMode: 'masonry'
});

var $gridcours = $('.grid_cours').isotope({
    itemSelector: '.grid-item',
    layoutMode: 'masonry',
    sortBy : 'random'
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


    if ($( this).attr('data-filter') === "#Adultes") {
        $('#coursadultes').removeClass('hidden');
        $('#coursenfants').addClass('hidden');
        $('#stages').addClass('hidden');
    }
    else if ($( this).attr('data-filter') === "#Enfants") {
        $('#coursenfants').removeClass('hidden');
        $('#coursadultes').addClass('hidden');
        $('#stages').addClass('hidden');

    }
    else if ($( this).attr('data-filter') === "#Stages") {
        $('#stages').removeClass('hidden');
        $('#coursenfants').addClass('hidden');
        $('#coursadultes').addClass('hidden');

    }
    else if ($( this).attr('data-filter') === "*") {
        $('#stages').addClass('hidden');
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

$(document).ready(function() {

    $('#modeles').DataTable({
        "pageLength": 10,
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
    );

} );
