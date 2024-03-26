import json
import sklearn
import numpy as np
from sklearn.datasets import make_classification
from sklearn.datasets import make_blobs


def distMinkowski(x1, x2, d):
    res = 0
    for i in range(len(x1)):
        #print(f"({x1[i]} - {x2[i]})**{d} = ", (x1[i] - x2[i]) ** d)
        res += (x1[i] - x2[i]) ** d
    return res**(1/d)


def distEuclidienne(x1, x2): return distMinkowski(x1, x2, 2)


def distManhattan(x1, x2): return distMinkowski(x1, x2, 1)


D7 = [(1, 3, 9,  6, 9, -2),
      (5, 8, 2, -2, 4,  5),
      (-4, 3, 4,  8, 1, -1),
      (10, 6, -10, -5, -4, - 7)]
res = []

for point in D7:
    mat = {}
    mat["Index"] = D7.index(point)
    mat["Voisin plus proche - Euclide"] = min([(distEuclidienne(point, x), D7.index(x)) for x in D7 if x != point])
    mat["Voisin plus proche - Manhattan"] = min([(distManhattan(point, x), D7.index(x)) for x in D7 if x != point])
    res.append(mat)

# for point in res:
#     print(point)

    # ----------------- Mahalanobis -----------------

random_state = 1
std = 1.
D, y = make_blobs(n_samples=1000, random_state=random_state, centers=1,
                  cluster_std=std, center_box=(0.0, 20.0))


def distMahalanobis(D, x1, x2):
    means = np.mean(D, axis=0)
    M = np.cov(D - means, rowvar=False)
    I = np.linalg.inv(M)
    res = np.matmul((x1 - x2), I)
    res = np.matmul(res, (x1 - x2))
    return np.sqrt(res)
    # for a, b in zip(x1, x2):
    #     res += (abs(a - b)) * I
    # return res**1/q


def distMaha(x1, x2, mat):
    mat = np.linalg.inv(mat)
    res = np.matmul((x1 - x2), mat)
    res = np.matmul(res, (x1 - x2))
    return np.sqrt(res)

    # ------------------ Dataset 1 ------------------

with open('datasets/dataset_mahalanobis_D.json', 'w') as json_file:
    json.dump(D.tolist(), json_file)

# print(D[456], " ", D[692])
# print(distMahalanobis(D, D[456], D[692]))
# print(distMahalanobis(D, D[164], D[410]))

    # ------------------ Dataset 2 ------------------

transformation = [[0.60834549, -0.63667341], [-0.40887718, 0.85253229]]
D_aniso = np.dot(D, transformation) + (10., 7.5)

with open('datasets/dataset_mahalanobis_D_aniso.json', 'w') as json_file:
    json.dump(D_aniso.tolist(), json_file)

# print(D_aniso[456], " ", D_aniso[692])
# print(distMahalanobis(D_aniso, D_aniso[456], D_aniso[692]))
# print(distMahalanobis(D_aniso, D_aniso[164], D_aniso[410]))

    # ------------------ Hamming ------------------


def distHamming(x1, x2):
    res = 0
    for a, b in zip(x1, x2):
        if a != b:
            res +=1
    return res


x1 = [1, 2, 2, 2, 1, 2, 1, 2, 1, 1]
x2 = [1, 2, 1, 1, 1, 2, 1, 2, 1, 2]
#print(distHamming(x1, x2))

# ------------------ Distance inter-cluster ------------------


def centroid(c):
    return np.mean(c, axis=0)


def distSINGLE(c1, c2, distF=distEuclidienne):
    return min([distF(x, y) for x in c1 for y in c2])


def distCOMPLETE(c1, c2, distF=distEuclidienne):
    return max([distF(x, y) for x in c1 for y in c2])


def distAVERAGE(c1, c2, distF=distEuclidienne):
    return np.mean([distF(x, y) for x in c1 for y in c2])


def distWARD(c1, c2, distF=distEuclidienne):
    n1 = len(c1)
    n2 = len(c2)
    dist = distF(centroid(c1), centroid(c2))
    n = (n1 * n2) / (n1 + n2)
    return np.sqrt(n) * dist

clust1 = [
    [1., -3.5],
    [2., 0.],
    [-1.5, -3.],
    [5., 2.]
]


# ------------------ Cluster 1 ------------------


std = 1.2
random_state = 1
cluster_1, y = make_blobs(n_samples=50, random_state=random_state,
                          centers=np.array([(8, 10)]), cluster_std=std,
                          center_box=(0.0, 20.0))

with open('datasets/dataset_cluster_1.json', 'w') as json_file:
    json.dump(cluster_1.tolist(), json_file)

# ------------------ Cluster 2 ------------------

random_state = 2
cluster_2, y = make_blobs(n_samples=50, random_state=random_state,
                          centers=np.array([(15, 12)]), cluster_std=std,
                          center_box=(0.0, 20.0))

with open('datasets/dataset_cluster_2.json', 'w') as json_file:
    json.dump(cluster_2.tolist(), json_file)


#print(distWARD(c1, c2))
#print(distAVERAGE(c1, c2))
#print(distCOMPLETE(c1, c2))
#print(distSINGLE(c1, c2))

# ------------------ Inertie intra-cluster ------------------


def inertie(c):
    return sum([distEuclidienne(x, centroid(c))**2 for x in c])


c1 = [[3], [9], [2], [1], [5]]
c2 = [[3, 4], [9, 2], [3, 6]]
c3 = [[3, 5, 8, 4], [3, 7, 10, -1], [3, 6, 6, 3]]

#print(inertie(c1), centroid(c1))
# print(inertie(c2), centroid(c2))
# print(inertie(c3), centroid(c3))

# ------------------ PARTITIONS ------------------

def centroidP(C):
    return sum([centroid(c) for c in C]) * (1/len(C))


def inertieIntraC(C):
    return sum([inertie(c) for c in C])


def inertieInterC(C):
    cg = centroidP(C)
    return sum([len(c) * distEuclidienne(centroid(c), cg) ** 2 for c in C])


def inertiePart(C): return inertieInterC(C) + inertieIntraC(C)


C = [cluster_1, cluster_2]
print(inertiePart(C))


def cha(D, k, distF, linkF):
    C = [[x] for x in D]

    while len(C) > k:
        M = [[linkF(x, y, distF) for x in C] for y in C]
        vmin = M[0][1]
        i = 0
        j = 1
        for a in range(len(M)):
            for b in range(len(M)):
                if a != b:
                    if M[a][b] < vmin:
                        vmin = M[a][b]
                        i = a
                        j = b
        c1, c2 = C[i], C[j]
        C.remove(c1)
        C.remove(c2)
        C.append(c1 + c2)
    return C


D = [
    [1., 1.],
    [1.5, 6.5],
    [-3., -4.],
    [4., -4.],
    [-3., 2.5],
    [-2., 5.]
]

for cluster in cha(D, 2, distEuclidienne, distAVERAGE):
    print(cluster)
