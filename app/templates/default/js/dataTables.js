$(document).ready(function() {
    $('#closedtable').dataTable({
        "language": {
            "url": "app/templates/default/js/dataTables-"+language+".json"
        }
    });
    $('#todotable').dataTable({
        "language": {
            "url": "app/templates/default/js/dataTables-"+language+".json"
        }
    });
    $('#opentable').dataTable({
        "language": {
            "url": "app/templates/default/js/dataTables-"+language+".json"
        }
    });
});
