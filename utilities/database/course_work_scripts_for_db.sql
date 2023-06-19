#get product info, its tags and image path
SELECT products.id, products.name, products.description, products.price, products.quantity, tags.tag, images.path 
FROM products
JOIN products_has_tags ON products.id = products_has_tags.products_id
JOIN tags ON products_has_tags.tags_id = tags.id
JOIN images ON  products.id = images.products_id
GROUP BY products.id
;