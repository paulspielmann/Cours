supprimerIntervalle :: (Int, Int) -> [Int] -> [Int]
supprimerIntervalle (a, b) xs = filter (\x -> x>= a && x <= b) xs

sontConjugues :: [Char] -> [Char] -> Bool
sontConjugues ma mb = if length ma /= length mb then False else aux (splitAt 1 ma) ma mb 1

subList :: Eq a => [a] -> [a] -> Bool
subList [] [] = True
subList _ []    = False
subList [] _    = True
subList (x:xs) (y:ys) 
    | x == y    = subList xs ys   
    | otherwise = subList (x:xs) ys

aux :: ([Char], [Char]) -> [Char] -> [Char] -> Int -> Bool
aux t ma mb n = if fst t `subList` mb && snd t `subList` mb then True else aux (splitAt (n + 1) ma) ma mb (n + 1)