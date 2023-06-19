import os
import time
import requests
import mysql.connector
import html2text
from bs4 import BeautifulSoup

# works with fishing zone
website_url = ''
tag = ''  # tag id in DB!!!

image_directory = 'images/shop items'
os.makedirs(image_directory, exist_ok=True)

db_config = {
    'user': 'root',
    'password': '1234',
    'host': 'localhost',
    'database': 'course_work'
}
conn = mysql.connector.connect(**db_config)
cursor = conn.cursor()


headers = {
    'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'
}

delay = 2

def scrape_product_details(product_url):
    
    response = requests.get('https://fishingzone.bg/'+product_url)
    soup = BeautifulSoup(response.content, 'html.parser')

    title_element = soup.find('h1', class_='js-product-title product-details__name mb-0')
    title = title_element.text.strip() if title_element else 'N/A'

    price_element = soup.find('div', class_='js-price prices__current')
    price = price_element.find('div', class_='prices__num').text.strip() if price_element else 'N/A'

    gallery_thumbs = []
    gallery_thumb_imgs = soup.find_all('img', class_='gallery__thumb-img')
    for img in gallery_thumb_imgs:
        src = img.get('src')
        if src:
            gallery_thumbs.append(src)

    product_info_div = soup.find('div', class_='js-product-info js-text-links acc')
    product_info = product_info_div.encode_contents().decode() if product_info_div else 'N/A'

    product_info = html2text.html2text(product_info)

    insert_query = '''
            INSERT INTO products (name, description, price)
            VALUES (%s, %s, %s)
        '''
    insert_data = (title, product_info, price)
    cursor.execute(insert_query, insert_data)
    conn.commit()

    product_id = cursor.lastrowid

    for i, thumb in enumerate(gallery_thumbs, 0):
        image_extension = os.path.splitext(thumb)[1]
        image_filename = f"{product_id}_{i}{image_extension}"
        image_path = os.path.join(image_directory, image_filename)
        img_name_in_site = thumb.split("/")[-1]

        insert_image_query = '''
                INSERT INTO images (products_id, path)
                VALUES (%s, %s)
            '''
        insert_image_data = (product_id, f"{product_id}_{i}{image_extension}")
        cursor.execute(insert_image_query, insert_image_data)
        conn.commit()

        with open(image_path, 'wb') as f:
            image_response = requests.get('https://fishingzone.bg/resources/'+img_name_in_site)
            f.write(image_response.content)

    insert_tag_query = '''
                INSERT INTO products_has_tags (products_id, tags_id)
                VALUES (%s, %s)
            '''
    insert_data = (product_id, tag)
    cursor.execute(insert_tag_query, insert_data)
    conn.commit()

    print('URL:', product_url)
    print('Title:', title)
    print('Price:', price)
    print('Gallery Thumbs:', gallery_thumbs)
    print('Product Info:')
    print(product_info)
    print('---') 

def scrape_product_pages():
    response = requests.get(website_url, headers=headers)
    soup = BeautifulSoup(response.content, 'html.parser')

    product_holders = soup.find_all('div', class_='product-card__holder')

    for holder in product_holders:
        link = holder.find('a', class_='product-card__link')
        if link:
            product_url = link['href']
            scrape_product_details(product_url)

            time.sleep(delay)

scrape_product_pages()