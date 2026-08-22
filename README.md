#	Entidad	Tabla	Depende de	Encargado
1	Rol	roles	—	Dev 1
2	Usuario	usuarios	roles	Dev 1
3	Cliente	clientes	—	Dev 2
4	Categoría	categorias	—	Dev 2
5	Producto	productos	categorias	Dev 2
6	Pedido	pedidos	clientes, usuarios	Dev 3
7	Detalle de pedido	detalle_pedido	pedidos, productos	Dev 3
8	Pago	pagos	pedidos, usuarios	Dev 3
9	Producción	producciones	pedidos, productos, usuarios	Dev 4
10	Trabajo de tapicero	trabajos_tapicero	producciones, usuarios	Dev 4
11	Historial de pedido	historial_pedidos	pedidos, usuarios	Dev 4