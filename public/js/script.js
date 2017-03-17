var widgetComponent = {
    props: ['title', 'content'],
    template:
    '<div class="portlet box">' +
    '<div class="portlet-title">' +
    '<div class="caption"><i class="fa fa-gift"></i><span v-text="title"></span></div>' +
    '</div>' +
    '<div class="portlet-body" v-html="content">' +
    '</div>' +
    '</div>'
}


var widgets = [
    {
        title: 'Widget News',
        content: 'News content',
        route: '/news',
        class: 'blue-hoki',
        size: 3
    },
    {
        title: 'Widget Bar',
        content: 'Bar content',
        route: '/bar',
        class: 'green',
        size: 3
    },

    {
        title: 'Widget News 2',
        content: 'News content',
        route: '/news',
        class: 'red-sunglo',
        size: 3
    },
    {
        title: 'Widget Bar 2',
        content: 'Bar content',
        route: '/bar',
        class: 'yellow',
        size: 3
    }
]

var rows = []

var app = new Vue({
    el: '#app',
    data: {
        title: 'Dashboard',
        widgets: widgets,
        rows: rows,
        rowindex: 0,

    },

    created: function () {
        var self = this;
        self.$http.get('/get-dashboard').then(function(response) {
            if(response.data.dashboard !=null) {
                self.rows = JSON.parse(response.data.dashboard);

                self.rows.forEach(function (row, i) {
                    row.items.forEach(function (item, k) {
                        self.getWidgetContent(item)
                    })
                })
            }
        }, function(error) {
            // error callback
        });

    },

    updated: function () {
        this.saveDashboard()
    },

    mounted: function(){
        var self = this;

        self.$nextTick(function(){
            $( "#sort" ).sortable({
                start: function(event, ui) {
                    from = ui.item.index();
                },
                update: function( event, ui ) {
                    to = ui.item.index()
                    var clonedRows = self.rows.filter(function(row){
                        return row;
                    });

                    clonedRows.splice(from, 1, self.rows[to])
                    clonedRows.splice(to, 1, self.rows[from])
                    self.rows = [];
                    self.$nextTick(function(){
                        self.rows = clonedRows;
                    });
                }
            });

            $( "#sort" ).on('mousemove', '.sortrow',function (e) {
                var irow = $( this ).parent('.portlet').index();
                
                $( ".sortrow" ).sortable({
                    start: function(event, ui) {
                        from = ui.item.index();
                    },
                    update: function( event, ui ) {
                        to = ui.item.index()
                        var clonedItems = self.rows[irow].items.filter(function(item){
                            return item;
                        });

                        clonedItems.splice(from, 1, self.rows[irow].items[to])
                        clonedItems.splice(to, 1, self.rows[irow].items[from])

                        self.rows[irow].items = []
                        self.$nextTick(function(){
                            self.rows[irow].items = clonedItems;
                        });
                    }
                });
                $('.sortrow .scroller').slimScroll({
                    //color: 'red',
                    //railColor: 'blue',
                    railVisible: true,
                    allowPageScroll: true,
                    alwaysVisible: true
                })

            });





        });


    },



    methods: {
        setRowIndex: function(index) {
            this.rowindex = index
            this.rows[index].show = true
        },

        addRow: function() {
            var r = {
                show: true,
                change: false,
                title: 'New row',
                items: []
            }
            this.rows.push(r)
        },

        copyRow: function(k) {
            this.rows.splice(k, 0, JSON.parse(JSON.stringify(this.rows[k])))
        },

        removeRow: function(k) {
            this.rows.splice(k, 1)
        },

        addWidget: function(widget) {
            var newWidget = JSON.parse(JSON.stringify(widget))
            newWidget.change = false
            this.getWidgetContent(newWidget)
            this.rows[this.rowindex].items.push(newWidget)

        },

        resizeMore: function(item) {
            if (item.size < 12) item.size += 1
        },

        resizeSmall: function(item) {
            if (item.size > 2) item.size -= 1
        },

        removeWidget: function (i, k) {
            this.rows[i].items.splice(k, 1)
        },

        getWidgetContent: function(item) {
           this.$http.get(item.route).then(function(response) {
               item.content = response.data
            }, function(error) {
                // error callback
            });
        },

        saveDashboard: function() {

            var rows = JSON.parse(JSON.stringify(this.rows))
            rows.forEach(function (row, i) {
                row.change = false
                row.items.forEach(function (item, k) {
                    item.content = ''
                    item.change = false
                })
            })


            this.$http.post('/set-dashboard', {dashboard: JSON.stringify(rows)}).then(function(response) {
                //console.log(response)
            }, function(error) {
                // error callback
            });

        }
    },
    components: {
        'widget-component': widgetComponent
    }
})



