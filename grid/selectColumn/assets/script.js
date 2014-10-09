/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

(function($){
    
    $.fn.grid = $.fn.grid || function(widget, opts){ 
        $.fn.grid[widget](this, opts); 
    };
    $.fn.grid.selectColumn = function(el, opts){
        console.log('selectColumn', el);
        $(el).on('change', opts.target, function(e){
            var _el = this;
            e.preventDefault();
            var url = $(this).data('url');
            var data = $(this).data('request');;
            data[$(this).data('name')] = $(this).val();
            
            $.ajax({
                url: url,
                data: data,
                type: $(this).data('method') || 'post',
                dataType: 'json',
                _success: function(data){
                    var gid = $(_el).data('grid-id');
                    $.fn.yiiGridView.update(gid);
                }
            });
            
        });
    };
    
})(jQuery);
