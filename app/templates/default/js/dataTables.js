$(document).ready(function() {
    $('#opentable').dataTable({
        "language": {
            "url": "app/templates/default/js/dataTables-"+language+".json"
        },
        "order": [[3,"asc"]]
    });
    $('#todotable').dataTable({
        "language": {
            "url": "app/templates/default/js/dataTables-"+language+".json"
        },
        "order": [[3,"asc"]]
    });
    $('#closedtable').dataTable({
        "language": {
            "url": "app/templates/default/js/dataTables-"+language+".json"
        },
        "order": [[3,"desc"]]
    });
});
