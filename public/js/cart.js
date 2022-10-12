$(document).ready(function(){
    //plus button click
    $(".btn-plus").click(function(){

        $parentNode = $(this).parents('tr');
        $price = Number($parentNode.find('#pizzaPrice').text().replace('kyats',''));

        $qty  = Number($parentNode.find('#qty').val());
        $total = $price*$qty;
        $parentNode.find('#total').html($total+" kyats");
        summaryCalculation();


    });
    //minus button click
    $(".btn-minus").click(function(){
        $parentNode = $(this).parents('tr');
        $price = Number($parentNode.find('#pizzaPrice').text().replace('kyats',''));
        $qty  = Number($parentNode.find('#qty').val());

        $total = $price*$qty;
        // console.log($total);
        $parentNode.find('#total').html($total+" kyats");

        summaryCalculation();
    });
    // //remove buttin click
    // $('.btnRemove').click(function(){
    //     $parentNode = $(this).parents('tr');
    //     $parentNode.remove();
    // })
    //total calculation function
    function summaryCalculation(){
        $totalPrice = 0;
        $('#dataTable tbody tr').each(function(index,row){
           $totalPrice +=  Number($(row).find('#total').text().replace('kyats',''));
        //    console.log($totalPrice);
        })
        $('#subTotal').html(`${$totalPrice}kyats`);
        $('#finalPrice').html(`${$totalPrice+5000} kyats`)
    }
});
