<?php
// Datos del Ano anterior 
$data1 = [
    "name" => "root",
    "children" => [
        ["name"=>"Samsung","value"=> 480],
        ["name"=>"Motorola","value"=> 130],
        ["name"=>"Iphone","value"=> 530],
        ["name"=>"Xiaomi","value"=> 430]
    ]
    ];
$data = [
        "name" => "root",
        "children" => [
            ["name"=>"Samsung","value"=> 500],
            ["name"=>"Motorola","value"=> 250],
            ["name"=>"Iphone","value"=> 600],
            ["name"=>"Xiaomi","value"=> 500]
        ]
        ];
// Crea un array con los datos resultantes

$result = ["name" => "root", "children" => []];
foreach ($data["children"] as $child) {
    foreach ($data1["children"] as $child1) {
        if ($child["name"] === $child1["name"]) {
            $oldValue = $child1["value"];
            $newValue = $child["value"];
            $change = $newValue - $oldValue;
            $percentageChange = ($change / $oldValue) * 100;

            $result["children"][] = [
                "name" => $child["name"],
                "old_value" => $oldValue,
                "new_value" => $newValue,
                "change" => $change,
                "percentage_change" => $percentageChange,
                "status" => $change > 0 ? "increased" : ($change < 0 ? "decreased" : "no change")
            ];
        }
    }
}
// Crea el treemap y renderiza en el html
function layoutTreemap($node, $x, $y, $width, $height, $nodesPerRow) {

        $rectangles = [];
        if (!isset($node['children'])) {
            $rectangles[] = [
                'name' => $node['name'],
                'x' => $x,
                'y' => $y,
                'width' => $width,
                'height' => $height
            ];
            return $rectangles;
        }
    
        // Total of percentage changes
        $total = array_sum(array_column($node['children'], 'new_value'));
        $rowHeight = $height / ceil(count($node['children']) / $nodesPerRow);
        $currentX = $x;
        $currentY = $y;
    
        foreach ($node['children'] as $index => $child) {
            $childWidth = ($child['new_value'] / $total) * $width;
            
            $rectangles[] = [
                'name' => $child['name'],
                'x' => $currentX,
                'y' => $currentY,
                'width' => $childWidth,
                'height' => $rowHeight,
                'value' => $child['percentage_change']
            ];
           
            $currentX += $childWidth;
    
            if (($index + 1) % $nodesPerRow == 0) {
                $currentX = $x;
                $currentY += $rowHeight;
            }
        }
        return $rectangles;
    }
    
    // Define the dynamic width and height based on your needs
    $containerWidth = 800;
    $containerHeight = 400;
    $nodesPerRow = 8;
    
    $treemapLayout = layoutTreemap($result, 0, 0, $containerWidth, $containerHeight, $nodesPerRow);
    
    ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Treemap</title>
        <style>
            .treemap {
                position: relative;
                width: <?= $containerWidth ?>px;
                height: <?= $containerHeight ?>px;
                border: 1px solid #ccc;
            }
            .node {
                position: absolute;
                border: 1px solid #333;
                box-sizing: border-box;
                overflow: hidden;
                font-size: 12px;
                padding: 5px;
                background-color: rgba(173, 216, 230, 0.8); /* Fondo azul claro con transparencia */
            }
        </style>
    </head>
    <body>
        <div class="treemap" id="treemap">
            <?php foreach ($treemapLayout as $node): ?>
                <div class="node" style="left: <?= $node['x'] ?>px; top: <?= $node['y'] ?>px; width: <?= $node['width'] ?>px; height: <?= $node['height'] ?>px;">
                    <p>Nome: <?= $node['name'] ?> </p><p>Valor: <?= round($node['value']) ?> </p>
                </div>
               
            <?php endforeach; ?>
          
        </div>
    </body>
</html>