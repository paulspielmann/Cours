pgcd :: Int -> Int -> Int
pgcd 0 0 = 0
pgcd a 0 = a
pgcd _ 1 = 1
pgcd a b | b > a        = pgcd b a 
         | mod a b == 0 = b
         | otherwise    = pgcd b (mod a b)