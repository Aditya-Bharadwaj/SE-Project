from bs4 import BeautifulSoup
import urllib.request
import json
import pathlib
#url = 'https://www.hackerrank.com/challenges/solve-me-first/problem'

domains = ['algorithms','cpp','data-structures','databases','fp','mathematics','java','shell','python','regex','sql']

def get_subdomains(domains):
	for domain in domains:
		url = 'https://www.hackerrank.com/domains/'
		url = url + domain
		url = urllib.request.urlopen(url)
		page = BeautifulSoup(url,'lxml')
		ul = page.findAll('ul',{'id':'challengeAccordion'})[0]
		li = ul.findAll('li')
		subdomain_links = ['https://www.hackerrank.com'+link.find('a')['href'] for link in li]
		subdomains[domain] = subdomain_links
	with open('subdomains.json','w+') as f:
		json.dump(subdomains,f,indent='\t')

def load_subdomains():
	with open('subdomains.json') as f:
		return json.load(f)

def final_index(p_list):
	for p in p_list:
		if 'Submissions:' in p.get_text():
			return p_list.index(p)

def extract_text(p_list):
	text = str()

	for p in p_list:
		text += str(p) + '\n'

	return text

def parse_problem_page(url,title,directory_path):
	page_data = dict()

	prob_url = urllib.request.urlopen(url)

	page = BeautifulSoup(prob_url,'lxml')

	#title = page.findAll('h2',{'class':'hr_tour-challenge-name pull-left mlT'})[0].get_text()
	#print(title)
	p_list = page.findAll('p')[1:]
	p_list = p_list[:final_index(p_list)]
	p_text = extract_text(p_list)

	#page_data['challenge_id'] = 'something'
	page_data['title'] = title
	page_data['domain'] = directory_path.split('\\')[0]
	page_data['subdomain'] = directory_path.split('\\')[1]
	page_data['text'] = p_text

	with open(directory_path+'\\'+ url.split('/')[4] +'.json','w+') as f:
		json.dump(page_data,f,indent='\t')

subdomain_urls = [
"https://www.hackerrank.com/domains/algorithms/implementation/3",
]

def parse_subdomain_page(url):
	subd_url = urllib.request.urlopen(url)
	page = BeautifulSoup(subd_url,'lxml')
	a_elems = page.findAll('a',{'class':"js-track-click"})
	links = ['https://www.hackerrank.com'+link['href'] for link in a_elems]
	titles = [link.get_text() for link in a_elems]
	problem_links = order_set(links)
	titles = order_set(titles)
	#print(titles)
	#print(problem_links)
	directory_path = url.split('/')[4] + '\\' + url.split('/')[5]
	pathlib.Path(directory_path).mkdir(parents=True, exist_ok=True) 
	return (directory_path,problem_links,titles)
#parse_page(url)
#get_subdomains(domains)
def order_set(seq):
    seen = set()
    seen_add = seen.add
    return [x for x in seq if not (x in seen or seen_add(x))]
#url = 'https://www.hackerrank.com/challenges/coin-change/problem'
#url = "https://www.hackerrank.com/domains/algorithms/warmup"
#parse_subdomain_page(url)
#subdomains = load_subdomains()
for subdomain_url in subdomain_urls:
	(directory_path,problem_links,titles) = parse_subdomain_page(subdomain_url)
	#for link in problem_links:
	#	parse_problem_page(link,directory_path)
	for num in range(len(problem_links)):
		parse_problem_page(problem_links[num],titles[num],directory_path)
	print('done with ' + subdomain_url.split('/')[4] + '/' + subdomain_url.split('/')[5])