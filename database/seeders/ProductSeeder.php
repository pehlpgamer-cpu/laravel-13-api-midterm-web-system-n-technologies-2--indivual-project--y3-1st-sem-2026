<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $products = [
            [
                'name' => 'Acer Nitro 5 15.6 inch Laptop',
                'description' => 'Gaming laptop with dedicated graphics and high refresh rate display.',
                'price' => 45000.00,
            ],
            [
                'name' => 'Xiaomi Redmi Note 14 4G 128GB',
                'description' => 'Affordable Android smartphone with 128GB internal storage.',
                'price' => 8500.00,
            ],
            [
                'name' => 'NatureHike Lightweight 20L Backpack',
                'description' => 'Compact lightweight backpack suitable for hiking and daily use.',
                'price' => 2500.00,
            ],
            [
                'name' => 'Hydro-Blaster MNL PX TTI G17',
                'description' => 'Toy water blaster designed for recreational outdoor games.',
                'price' => 3200.00,
            ],
            [
                'name' => 'EcoFlow River 2 Pro 500Wh',
                'description' => 'Portable power station for camping and emergency backup power.',
                'price' => 36000.00,
            ],
            [
                'name' => 'CAT Tourniquet Orange',
                'description' => 'Emergency first-aid tourniquet for controlling severe bleeding.',
                'price' => 2000.00,
            ],
            [
                'name' => 'Logitech G102 Gaming Mouse',
                'description' => 'Wired gaming mouse with programmable buttons and RGB lighting.',
                'price' => 950.00,
            ],
            [
                'name' => 'Logitech K380 Bluetooth Keyboard',
                'description' => 'Compact wireless keyboard compatible with multiple devices.',
                'price' => 1750.00,
            ],
            [
                'name' => 'Samsung Galaxy A16 128GB',
                'description' => 'Mid-range Android smartphone with a large AMOLED display.',
                'price' => 8990.00,
            ],
            [
                'name' => 'Apple iPhone 15 128GB',
                'description' => 'Apple smartphone with advanced camera and powerful processor.',
                'price' => 42990.00,
            ],
            [
                'name' => 'ASUS TUF Gaming A15 Laptop',
                'description' => 'Durable gaming laptop designed for gaming and productivity.',
                'price' => 52990.00,
            ],
            [
                'name' => 'Lenovo IdeaPad Slim 3 Laptop',
                'description' => 'Lightweight laptop suitable for students and office work.',
                'price' => 28990.00,
            ],
            [
                'name' => 'HP Victus 15 Gaming Laptop',
                'description' => 'Gaming laptop with dedicated GPU and full HD display.',
                'price' => 49990.00,
            ],
            [
                'name' => 'Dell Inspiron 15 Laptop',
                'description' => 'General-purpose laptop for school, work, and entertainment.',
                'price' => 32990.00,
            ],
            [
                'name' => 'MacBook Air M3 13-inch',
                'description' => 'Thin and lightweight Apple laptop powered by the M3 chip.',
                'price' => 64990.00,
            ],
            [
                'name' => 'Samsung Galaxy Tab A9',
                'description' => 'Compact Android tablet for media consumption and productivity.',
                'price' => 9990.00,
            ],
            [
                'name' => 'Apple iPad 10th Generation',
                'description' => 'Versatile tablet suitable for studying, entertainment, and creative work.',
                'price' => 24990.00,
            ],
            [
                'name' => 'Xiaomi Pad 7',
                'description' => 'Android tablet with high-resolution display and powerful processor.',
                'price' => 19990.00,
            ],
            [
                'name' => 'Sony WH-1000XM5 Headphones',
                'description' => 'Wireless over-ear headphones with active noise cancellation.',
                'price' => 18990.00,
            ],
            [
                'name' => 'JBL Tune 720BT Headphones',
                'description' => 'Wireless Bluetooth headphones with long battery life.',
                'price' => 2990.00,
            ],
            [
                'name' => 'Apple AirPods Pro 2',
                'description' => 'Wireless earbuds featuring active noise cancellation.',
                'price' => 12990.00,
            ],
            [
                'name' => 'Samsung Galaxy Buds FE',
                'description' => 'Compact wireless earbuds designed for everyday listening.',
                'price' => 4990.00,
            ],
            [
                'name' => 'Soundcore Liberty 4 NC',
                'description' => 'Wireless earbuds with noise cancellation and extended battery life.',
                'price' => 4995.00,
            ],
            [
                'name' => 'Razer BlackShark V2 X Headset',
                'description' => 'Lightweight gaming headset with surround sound support.',
                'price' => 2390.00,
            ],
            [
                'name' => 'HyperX Cloud Stinger 2',
                'description' => 'Comfortable gaming headset with directional audio.',
                'price' => 2790.00,
            ],
            [
                'name' => 'Keychron K2 Mechanical Keyboard',
                'description' => 'Compact wireless mechanical keyboard for work and gaming.',
                'price' => 4490.00,
            ],
            [
                'name' => 'Royal Kludge RK61 Keyboard',
                'description' => 'Compact 60 percent mechanical keyboard with wireless connectivity.',
                'price' => 1990.00,
            ],
            [
                'name' => 'Redragon K552 Mechanical Keyboard',
                'description' => 'Affordable mechanical gaming keyboard with compact layout.',
                'price' => 1690.00,
            ],
            [
                'name' => 'Logitech MX Master 3S Mouse',
                'description' => 'Premium wireless mouse designed for productivity.',
                'price' => 5990.00,
            ],
            [
                'name' => 'Razer DeathAdder Essential Mouse',
                'description' => 'Ergonomic wired gaming mouse with precision sensor.',
                'price' => 1290.00,
            ],
            [
                'name' => 'SteelSeries Rival 3 Mouse',
                'description' => 'Lightweight gaming mouse with programmable RGB lighting.',
                'price' => 1890.00,
            ],
            [
                'name' => 'Samsung 24-inch IPS Monitor',
                'description' => 'Full HD monitor with IPS panel for work and entertainment.',
                'price' => 6990.00,
            ],
            [
                'name' => 'LG UltraGear 24-inch Gaming Monitor',
                'description' => 'High refresh rate gaming monitor with Full HD resolution.',
                'price' => 10990.00,
            ],
            [
                'name' => 'AOC 27-inch IPS Monitor',
                'description' => 'Large Full HD IPS monitor with slim bezels.',
                'price' => 8990.00,
            ],
            [
                'name' => 'ASUS TUF VG249Q3A Monitor',
                'description' => 'High refresh rate gaming monitor designed for competitive gaming.',
                'price' => 11990.00,
            ],
            [
                'name' => 'Kingston NV2 1TB NVMe SSD',
                'description' => 'Fast NVMe solid-state drive for laptops and desktop computers.',
                'price' => 3290.00,
            ],
            [
                'name' => 'Samsung 990 EVO 1TB SSD',
                'description' => 'High-performance NVMe SSD with fast read and write speeds.',
                'price' => 5790.00,
            ],
            [
                'name' => 'Crucial BX500 500GB SSD',
                'description' => 'Affordable SATA SSD suitable for upgrading older computers.',
                'price' => 1890.00,
            ],
            [
                'name' => 'Seagate Barracuda 2TB HDD',
                'description' => 'Desktop hard drive for large-capacity file storage.',
                'price' => 3290.00,
            ],
            [
                'name' => 'Western Digital Blue 1TB HDD',
                'description' => 'Reliable hard drive designed for desktop computers.',
                'price' => 2490.00,
            ],
            [
                'name' => 'Kingston Fury Beast 16GB DDR4 RAM',
                'description' => 'Desktop memory module suitable for gaming and productivity.',
                'price' => 2290.00,
            ],
            [
                'name' => 'Corsair Vengeance 32GB DDR5 RAM',
                'description' => 'High-speed DDR5 memory kit for modern desktop computers.',
                'price' => 6490.00,
            ],
            [
                'name' => 'AMD Ryzen 5 5600 Processor',
                'description' => 'Six-core desktop processor suitable for gaming and productivity.',
                'price' => 6990.00,
            ],
            [
                'name' => 'AMD Ryzen 7 5700X Processor',
                'description' => 'Eight-core processor designed for gaming and content creation.',
                'price' => 10990.00,
            ],
            [
                'name' => 'Intel Core i5-12400F Processor',
                'description' => 'Six-core desktop processor offering strong gaming performance.',
                'price' => 7490.00,
            ],
            [
                'name' => 'Intel Core i7-14700K Processor',
                'description' => 'High-performance desktop CPU for gaming and professional workloads.',
                'price' => 25990.00,
            ],
            [
                'name' => 'ASUS PRIME B550M-A Motherboard',
                'description' => 'Micro-ATX motherboard supporting AMD Ryzen processors.',
                'price' => 5490.00,
            ],
            [
                'name' => 'MSI B760 Gaming Plus Motherboard',
                'description' => 'Gaming motherboard supporting modern Intel processors.',
                'price' => 9990.00,
            ],
            [
                'name' => 'Gigabyte RTX 4060 8GB Graphics Card',
                'description' => 'Mid-range graphics card designed for high-quality 1080p gaming.',
                'price' => 19990.00,
            ],
            [
                'name' => 'ASUS RTX 4070 Super 12GB Graphics Card',
                'description' => 'High-performance graphics card suitable for 1440p gaming.',
                'price' => 39990.00,
            ],
            [
                'name' => 'Sapphire Radeon RX 7600 Graphics Card',
                'description' => 'Gaming graphics card optimized for Full HD gaming.',
                'price' => 17490.00,
            ],
            [
                'name' => 'Corsair CX650 650W Power Supply',
                'description' => 'Reliable power supply suitable for gaming desktop computers.',
                'price' => 3690.00,
            ],
            [
                'name' => 'Cooler Master MWE 750W Power Supply',
                'description' => 'Efficient power supply for mid-range and high-performance computers.',
                'price' => 4790.00,
            ],
            [
                'name' => 'NZXT H5 Flow PC Case',
                'description' => 'Mid-tower computer case with optimized airflow.',
                'price' => 5290.00,
            ],
            [
                'name' => 'Tecware Forge M Omni PC Case',
                'description' => 'Affordable airflow-focused micro-ATX computer case.',
                'price' => 2890.00,
            ],
            [
                'name' => 'DeepCool AK400 CPU Cooler',
                'description' => 'Tower air cooler designed for efficient CPU cooling.',
                'price' => 1990.00,
            ],
            [
                'name' => 'Thermalright Peerless Assassin 120',
                'description' => 'Dual-tower CPU air cooler for high-performance processors.',
                'price' => 2490.00,
            ],
            [
                'name' => 'TP-Link Archer AX23 WiFi 6 Router',
                'description' => 'Dual-band WiFi 6 router for fast home networking.',
                'price' => 2990.00,
            ],
            [
                'name' => 'TP-Link Deco X20 Mesh WiFi System',
                'description' => 'Mesh WiFi system designed for whole-home wireless coverage.',
                'price' => 7990.00,
            ],
            [
                'name' => 'Ubiquiti UniFi U6 Plus Access Point',
                'description' => 'WiFi 6 wireless access point for home and office networks.',
                'price' => 6990.00,
            ],
            [
                'name' => 'D-Link 8-Port Gigabit Switch',
                'description' => 'Compact network switch with eight Gigabit Ethernet ports.',
                'price' => 1490.00,
            ],
            [
                'name' => 'TP-Link 24-Port Gigabit Switch',
                'description' => 'Network switch suitable for small offices and computer laboratories.',
                'price' => 4990.00,
            ],
            [
                'name' => 'UGREEN Cat6 Ethernet Cable 5m',
                'description' => 'High-speed Ethernet cable for wired network connections.',
                'price' => 350.00,
            ],
            [
                'name' => 'UGREEN USB-C Hub 6-in-1',
                'description' => 'Multiport USB-C adapter with HDMI and USB connectivity.',
                'price' => 1890.00,
            ],
            [
                'name' => 'Anker 20W USB-C Charger',
                'description' => 'Compact fast charger compatible with smartphones and tablets.',
                'price' => 990.00,
            ],
            [
                'name' => 'UGREEN 65W GaN Charger',
                'description' => 'Compact multiport charger suitable for laptops and smartphones.',
                'price' => 2190.00,
            ],
            [
                'name' => 'Anker PowerCore 20000mAh Power Bank',
                'description' => 'High-capacity portable battery charger for mobile devices.',
                'price' => 2490.00,
            ],
            [
                'name' => 'Baseus Blade 100W Power Bank',
                'description' => 'High-output portable power bank capable of charging laptops.',
                'price' => 3990.00,
            ],
            [
                'name' => 'Sandisk Ultra 128GB USB Flash Drive',
                'description' => 'Portable USB storage device for files and backups.',
                'price' => 690.00,
            ],
            [
                'name' => 'Kingston DataTraveler 256GB USB Drive',
                'description' => 'High-capacity portable flash storage device.',
                'price' => 1290.00,
            ],
            [
                'name' => 'SanDisk Extreme 1TB Portable SSD',
                'description' => 'Fast and durable external SSD for portable file storage.',
                'price' => 6990.00,
            ],
            [
                'name' => 'WD My Passport 2TB External Drive',
                'description' => 'Portable external hard drive for backups and file storage.',
                'price' => 4290.00,
            ],
            [
                'name' => 'Canon EOS R50 Mirrorless Camera',
                'description' => 'Compact mirrorless camera suitable for photography and video.',
                'price' => 39990.00,
            ],
            [
                'name' => 'Sony ZV-E10 Camera',
                'description' => 'Mirrorless camera designed for content creators and vloggers.',
                'price' => 35990.00,
            ],
            [
                'name' => 'GoPro Hero 13 Black',
                'description' => 'Rugged action camera for outdoor video recording.',
                'price' => 24990.00,
            ],
            [
                'name' => 'DJI Osmo Action 5 Pro',
                'description' => 'Compact action camera with stabilization for outdoor recording.',
                'price' => 22990.00,
            ],
            [
                'name' => 'DJI Mini 4 Pro Drone',
                'description' => 'Compact camera drone designed for aerial photography.',
                'price' => 45990.00,
            ],
            [
                'name' => 'DJI Osmo Mobile 6 Gimbal',
                'description' => 'Smartphone stabilizer designed for smooth video recording.',
                'price' => 7990.00,
            ],
            [
                'name' => 'JBL Flip 6 Bluetooth Speaker',
                'description' => 'Portable waterproof Bluetooth speaker with powerful sound.',
                'price' => 6990.00,
            ],
            [
                'name' => 'Sony SRS-XB100 Bluetooth Speaker',
                'description' => 'Compact portable wireless speaker with enhanced bass.',
                'price' => 2990.00,
            ],
            [
                'name' => 'Marshall Emberton II Speaker',
                'description' => 'Portable Bluetooth speaker with classic Marshall styling.',
                'price' => 8990.00,
            ],
            [
                'name' => 'Xiaomi Smart Band 9',
                'description' => 'Fitness tracker with heart rate monitoring and activity tracking.',
                'price' => 2290.00,
            ],
            [
                'name' => 'Samsung Galaxy Watch 7',
                'description' => 'Smartwatch with health monitoring and fitness tracking.',
                'price' => 15990.00,
            ],
            [
                'name' => 'Apple Watch Series 10',
                'description' => 'Smartwatch with fitness, health, and notification features.',
                'price' => 24990.00,
            ],
            [
                'name' => 'Garmin Forerunner 165',
                'description' => 'GPS running smartwatch designed for fitness enthusiasts.',
                'price' => 16990.00,
            ],
            [
                'name' => 'Xiaomi Smart Air Fryer 4.5L',
                'description' => 'Digital air fryer for convenient low-oil cooking.',
                'price' => 3490.00,
            ],
            [
                'name' => 'Philips Essential Air Fryer',
                'description' => 'Compact air fryer designed for healthier home cooking.',
                'price' => 5990.00,
            ],
            [
                'name' => 'Hanabishi Rice Cooker 1.8L',
                'description' => 'Electric rice cooker suitable for everyday household use.',
                'price' => 1590.00,
            ],
            [
                'name' => 'Tefal Electric Kettle 1.7L',
                'description' => 'Electric kettle with automatic shutoff feature.',
                'price' => 1690.00,
            ],
            [
                'name' => 'Xiaomi Electric Kettle 2',
                'description' => 'Minimalist electric kettle for quickly boiling water.',
                'price' => 1390.00,
            ],
            [
                'name' => 'Astron Stand Fan 16-inch',
                'description' => 'Electric stand fan with adjustable speed settings.',
                'price' => 1890.00,
            ],
            [
                'name' => 'Xiaomi Smart Standing Fan 2',
                'description' => 'Quiet smart electric fan controllable through a mobile app.',
                'price' => 4490.00,
            ],
            [
                'name' => 'Dyson V8 Cordless Vacuum',
                'description' => 'Cordless vacuum cleaner designed for convenient household cleaning.',
                'price' => 18990.00,
            ],
            [
                'name' => 'Deerma DX700 Vacuum Cleaner',
                'description' => 'Affordable handheld and upright vacuum cleaner.',
                'price' => 2290.00,
            ],
            [
                'name' => 'Coleman Sundome 4-Person Tent',
                'description' => 'Camping tent suitable for four people.',
                'price' => 5990.00,
            ],
            [
                'name' => 'NatureHike Cloud Up 2 Tent',
                'description' => 'Lightweight two-person tent suitable for hiking and camping.',
                'price' => 6490.00,
            ],
            [
                'name' => 'NatureHike Folding Camping Chair',
                'description' => 'Portable lightweight chair for camping and outdoor activities.',
                'price' => 1490.00,
            ],
            [
                'name' => 'Stanley Adventure Vacuum Bottle 1L',
                'description' => 'Insulated stainless steel bottle for hot and cold beverages.',
                'price' => 2490.00,
            ],
            [
                'name' => 'Hydro Flask 32oz Bottle',
                'description' => 'Insulated water bottle designed to maintain beverage temperature.',
                'price' => 2290.00,
            ],
            [
                'name' => 'Osprey Daylite 26L Backpack',
                'description' => 'Versatile backpack designed for travel and outdoor activities.',
                'price' => 4990.00,
            ],
        ];

        foreach ($products as $i) {
            Product::create([
                'name' => $i['name'],
                'description' => $i['description'],
                'price' => $i['price'],
            ]);
        }

        // Product::insert($products); // <-- this causes a sql error

        // Product::factory()->count(100)->create();
    }
}
