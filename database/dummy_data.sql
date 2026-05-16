INSERT INTO users(name,email,password) VALUES ('Administrator','admin@demo.com','$2y$12$.wCfTofgO6r8EQ1ylQa4fuPL6C0T.Z9KnqcXU5CJpLbXpJ1.ShwR2');
INSERT INTO themes(name,slug,primary_color,secondary_color) VALUES
('Elegant Gold','elegant-gold','#D4AF37','#1F2937'),('Islamic Green','islamic-green','#0F766E','#134E4A'),('Minimal White','minimal-white','#F9FAFB','#111827'),('Dark Luxury','dark-luxury','#09090B','#A16207'),('Floral Pink','floral-pink','#F9A8D4','#831843'),('Rustic Brown','rustic-brown','#92400E','#451A03'),('Korean Style','korean-style','#E5E7EB','#9CA3AF'),('Modern Black','modern-black','#000000','#52525B'),('Anime Theme','anime-theme','#7C3AED','#EC4899');
INSERT INTO wishes(guest_name,message,created_at) VALUES ('Rani','Semoga sakinah mawaddah warahmah',NOW()),('Budi','Selamat menempuh hidup baru!',NOW());
INSERT INTO packages(name,price,duration_days) VALUES ('Silver 30 Hari',99000,30),('Gold 90 Hari',199000,90),('Platinum 180 Hari',299000,180);
INSERT INTO buyers(name,email,password) VALUES ('Buyer Demo','buyer@demo.com','$2y$12$vBAUTee4y4EwezeBPTf.LeQoIi04UjMt3mgsiPpE7yq9ROHbjLRUK');
