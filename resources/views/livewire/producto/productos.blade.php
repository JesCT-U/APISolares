<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Productos') }}
        </h2>
    </x-slot>
    <div class="py-8 px-16">
        <div class="px-8 pt-8 pb-4 bg-white rounded-lg">
            <div class="px-24 py-2">
                <button wire:click="openModal()" type="button" class="text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2" data-modal-toggle="defaultModal">Crear</button>
            </div>
            @if($open)
                @include('livewire.producto.productos-crear')
            @endif
            <table class="w-full text-center">
                <thead class="text-white">
                    <tr>
                        <th class="py-6 bg-gray-700 px-2 rounded-tl-lg">ID</th>
                        <th class="py-6 bg-gray-700">codigo</th>
                        <th class="py-6 bg-gray-700">productos</th>
                        <th class="py-6 bg-gray-700">descripción</th>
                        <th class="py-6 bg-gray-700">precio</th>
                        <th class="py-6 bg-gray-700">precio de compra</th>
                        <th class="py-6 bg-gray-700">stock</th>
                        <th class="py-6 bg-gray-700">stock minimo</th>
                        <th class="py-6 bg-gray-700">categoria</th>
                        <th class="py-6 bg-gray-700 rounded-tr-lg">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($datos as $productos)
                        <tr>
                            <td class="py-6 px-2 bg-gray-700 text-white">{{$productos->productos_id}}</td>
                            <td class="py-6 px-2 bg-gray-300">{{$productos->codigo}}</td>
                            <td class="py-6 px-2 bg-gray-300">{{$productos->producto}}</td>
                            <td class="py-6 px-2 bg-gray-300">{{$productos->descripcion}}</td>
                            <td class="py-6 px-2 bg-gray-300">Q. {{number_format($productos->precio,2,'.',',')}}</td>
                            <td class="py-6 px-2 bg-gray-300">Q. {{number_format($productos->precio_compra,2,'.',',')}}</td>
                            <td class="py-6 px-2 bg-gray-300">{{$productos->stock}}</td>
                            <td class="py-6 px-2 bg-gray-300">{{$productos->stock_min}}</td>
                            <td class="py-6 px-2 bg-gray-300">{{$productos->categoria}}</td>
                            <td class="py-6 px-2 bg-gray-300">
                                <button wire:click="eliminar({{$productos->productos_id}})" type="button" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Eliminar</button>
                                <button wire:click="editar({{$productos->productos_id}})" type="button" class="text-white bg-gradient-to-r from-pink-400 via-pink-500 to-pink-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-pink-300 dark:focus:ring-pink-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Editar</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
