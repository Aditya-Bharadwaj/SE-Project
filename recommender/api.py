import json

from prepare_data import create_rating_matrix, get_item_similarity_matrix
from recommend import Recommendations
from constants import CHALLENGES_FILE, SUBMISSIONS_FILE, TARGET_CONTEST_ID
from os.path import dirname, abspath

CHALLENGES_FILE =  'datasets/challenges_sample.csv'
SUBMISSIONS_FILE =   'datasets/submissions_sample.csv'

TARGET_CONTEST_ID = 'c8ff662c97d345d2'

if __name__ == '__main__':
	rating_matrix, hacker_dict, challenge_dict = create_rating_matrix(CHALLENGES_FILE, SUBMISSIONS_FILE)
	similarity_matrix = get_item_similarity_matrix(rating_matrix)

	print('Getting Recommendations')
	all_recommendations = {}
    #for hacker_id in hacker_dict:
	hacker_id = 'c3c1e5535e9bd384'
	R = Recommendations.get_instance(TARGET_CONTEST_ID, CHALLENGES_FILE)
	recommendations = R.get_top_k_recommendations(rating_matrix, similarity_matrix, hacker_id, hacker_dict, challenge_dict)
	all_recommendations[hacker_id] = recommendations

	with open('all_recommendations.json', 'w') as f:
		json.dump(all_recommendations, f)

