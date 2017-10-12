@extends('welcome')

@section('content')

    <a data-bind="click:newDialog"> Add new product</a>

    <ul class="groceries" data-bind="foreach: products">

        {{--<li><span data-bind="text: naam"></span> <a data-bind="click: $parent.toggleChecked">tajsdnjasdn</a></li>--}}

        <li>
		
            {{--<a data-bind="text: naam, click:toggleChecked, style: { color : checked < 1 ? 'red' : 'black' }"> </a>--}}
            <a data-bind="text: naam, attr:{'id': id}, css:{ checked : checked }, click:toggleChecked"> </a>

            <span data-bind="click:renameDialog">    |  Edit</span>
            <span data-bind="click:remove">| Remove</span>
            {{--<a href="#" data-bind="click: toggleChecked">check</a>--}}
        </li>
    </ul>

    @endsection


@section('scripts')


    <script>




        function ViewModel(){
            products = ko.observableArray({!! $products !!});



            /**
             * Product in of uitchecken
             */
            toggleChecked = function(product, event){
                $("#" + event.target.id).toggleClass("checked");
                product.checked= !product.checked;

                update(product, "");
            };


            /**
             *  Hernoem Dialoog weergeven
             */
            renameDialog = function(product){
                console.log("foo");
               var window =  prompt("Product Wijzigen", product.naam);

                if (window){
                    update(product, window);
                }
                resetNaam(window, product.id);

            };


            /**
             * Product updaten
             */
            update = function(product, foo){
                url = "{!! url('') !!}";
                var checked = product.checked ? 1 : 0;
                $.ajax({
                    url: url + "/update/" + product.id,
                    type: 'post',
                    data: {checked: checked, naam: foo}
                });

            }

            /**
             * Tekst van product veranderen
             * @param naam
             * @param id
             */
            resetNaam = function (naam, id) {
                $("#" + id).text(naam);
            };

            /**
             * Product verwijderen, uit lijst en request maken.
             */
            remove = function(product){
                url = "{!! url('') !!}";
                $.ajax({
                    url: url + "/delete/" + product.id,
                    type: 'post'
                });
                products.remove(this);
            }

            /**
             * Nieuw product dialoog weergeven.
             * @param product
             */
            newDialog = function(product){
                var window =  prompt("Product Wijzigen", "Product Naam");

                if (window){
                    newProduct(product, window);
                }
            }

            /**
             * Product dialog is correct ingevult, nieuw product aanmaken.
             * @param product
             * @param window
             */
            newProduct = function(product, window){
                url = "{!! url('') !!}";
                $.ajax({
                    url: url + "/new",
                    type: 'post',
                    data: {checked: 0, naam: window}
                });

                location.reload();
            }



        }


        ko.applyBindings(new ViewModel());



    </script>

    @endsection


{{--isChecked  = function(product){--}}
{{--//            var viewModel = {--}}
{{--//                test : ko.observable(product.checked ? true : false)--}}
{{--//            };--}}
{{--//        };--}}
