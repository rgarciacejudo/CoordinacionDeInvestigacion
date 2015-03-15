/**
 *
 * Funciones del sistema 
 * 
 */

$(document).ready(function(){
    
    /**
     * Hace que el componente calendar aparezca al darle click
     */
    $('.li_calendar').click(function(){
       $($($(this).parent()).next().children()[0]).datepicker('show');
    });
});