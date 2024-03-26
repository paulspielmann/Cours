estPeriode :: Eq a => Int -> [a] -> Bool
--estPeriode n xs | n < 1 || n > length xs = False
--                | otherwise = aux n xs 0
estPeriode n l
    | n < 1 || n > length l = False
    | otherwise = take (length l - n) l == drop n l


aux :: Eq a => Int -> [a] -> Int -> Bool
aux n xs acc | acc + n >= length xs = True
             | xs !! (acc + n) == xs !! acc = aux n xs (acc + n)
             | otherwise = False

periodes :: Eq a => [a] -> [Int]
periodes xs = [n | n <- [1..(length xs - 1)], estPeriode n xs]