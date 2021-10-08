"use strict";

// Class definition

var KTKanbanBoardDemo = function() {
    // Private functions
    var _demo1 = function() {
        var kanban = new jKanban({
            element: '#kt_kanban_1',
            gutter: '0',
            widthBoard: '250px',
            boards: [{
                    'id': '_inprocess',
                    'title': 'In Process',
                    'item': [{
                            'title': '<span class="font-weight-bold">You can drag me too</span>'
                        },
                        {
                            'title': '<span class="font-weight-bold">Buy Milk</span>'
                        }
                    ]
                }, {
                    'id': '_working',
                    'title': 'Working',
                    'item': [{
                            'title': '<span class="font-weight-bold">Do Something!</span>'
                        },
                        {
                            'title': '<span class="font-weight-bold">Run?</span>'
                        }
                    ]
                }, {
                    'id': '_done',
                    'title': 'Done',
                    'item': [{
                            'title': '<span class="font-weight-bold">All right</span>'
                        },
                        {
                            'title': '<span class="font-weight-bold">Ok!</span>'
                        }
                    ]
                }
            ]
        });
    }

    // Public functions
    return {
        init: function() {
            _demo1();
        }
    };
}();

jQuery(document).ready(function() {
    KTKanbanBoardDemo.init();
});
