import pandas as pd
import numpy as np

from scipy.sparse import csr_matrix, coo_matrix
from db_read import getFromDB
#creation of rating_matrix that has the hacker_id and challenge_id
def create_rating_matrix():
	print('Reading submissions.csv')

	#print("check")
	submissions_df = getFromDB()
	data, rows, cols = [], [], []
	hacker_dict, challenge_dict = {}, {}
	rowcols = set([])

	print('Creating Sparse Matrix')
	for idx, row in submissions_df.iterrows():
		hacker_id, challenge_id = row['hacker_id'], row['challenge_id']

		if hacker_id not in hacker_dict:
			hacker_dict[hacker_id] = len(hacker_dict)

		if challenge_id not in challenge_dict:
			challenge_dict[challenge_id] = len(challenge_dict)

		row_idx, col_idx = challenge_dict[challenge_id], hacker_dict[hacker_id]

		if (row_idx, col_idx) not in rowcols:
			rows.append(row_idx)
			cols.append(col_idx)
			data.append(1)
			rowcols.add((row_idx, col_idx))
	shape = (len(challenge_dict), len(hacker_dict))
	#print("check chall",len(challenge_dict))
	#print("check shape",shape)
	data = np.array(data)
	matrix = coo_matrix((data, (rows, cols)), shape=shape)

	matrix = matrix.tocsr()

	return matrix, hacker_dict, challenge_dict


def get_item_similarity_matrix(rating_matrix):
	print('Creating Item similarity matrix')
    
	A = rating_matrix.astype(np.int64)
	#print(rating_matrix)
	m = sparse_corrcoef(A)
	#print("check ",len(m))
	return m

def sparse_corrcoef(A, B=None):

    A = A.astype(np.float64)

    # compute the covariance matrix
    A = A - A.mean(1)
    norm = A.shape[1] - 1.
    C = A.dot(A.T.conjugate()) / norm
    d = np.diag(C)
    coeffs = C / np.sqrt(np.outer(d, d))

    return coeffs




