import pymysql
import pandas as pd
# Open database connection
def getFromDB():
	db = pymysql.connect("localhost","root","","codemanch" )

	cursor = db.cursor()

	sql = "SELECT * FROM submissions"
	# Execute the SQL command
	cursor.execute(sql)
	# Fetch all the rows in a list.
	results = cursor.fetchall()
	matrix = [] 
	for row in results:
		matrix.append((row[0],row[1]))
		#print(row[0]+" "+row[1])
	label = ['hacker_id','challenge_id']
	df = pd.DataFrame.from_records(matrix,columns=label)
	#print(df)

	# disconnecting from server
	db.close()
	return df