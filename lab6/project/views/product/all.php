
<table>
    <tr style="background-color: #ffe0e0;">
        <th style="padding: 10px;">ID</th>
        <th style="padding: 10px;">Название</th>
        <th style="padding: 10px;">Цена</th>
        <th style="padding: 10px;">Количество</th>
        <th style="padding: 10px;">Категория</th>
        <th style="padding: 10px;">Общая стоимость</th>
    </tr>
    <?php foreach ($products as $id => $product): ?>
    <tr>
        <td style="padding: 10px;"><?php echo $id; ?></td>
        <td style="padding: 10px;"><?php echo $product['name']; ?></td>
        <td style="padding: 10px;"><?php echo $product['price']; ?>$</td>
        <td style="padding: 10px;"><?php echo $product['quantity']; ?></td>
        <td style="padding: 10px;"><?php echo $product['category']; ?></td>
        <td style="padding: 10px;"><?php echo $product['price'] * $product['quantity']; ?>$</td>
    </tr>
    <?php endforeach; ?>
</table>