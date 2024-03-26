-- 1 - Retour sur les listes

head' :: [a] -> Maybe a
head' [] = Nothing
head' (x:_) = Just x

last' :: [a] -> Maybe a
last' [] = Nothing
last' (x:[]) = Just x
last' (x:xs) = last' xs 

tail' :: [a] -> Maybe [a]
tail' [] = Nothing
tail' (x:xs) = Just xs

init' :: [a] -> Maybe [a]
init' [] = Nothing
init' (x:xs) = Just (init'' x xs)
    where init'' _ [] = []
          init'' y (z:zs) = y : init'' z zs 