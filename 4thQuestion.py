import requests
import pandas as pd

url = "https://wft-geo-db.p.rapidapi.com/v1/geo/countries/NZ/places"

headers = {
    'X-RapidAPI-Key': "7aa4df44a9msh9a4a17c38d679cap1aa232jsn4c60fe59e2a8", 
    'X-RapidAPI-Host': "wft-geo-db.p.rapidapi.com"
}

response = requests.get(url, headers=headers)

if response.status_code == 200:
    data = response.json()['data']

    
    cols = ["placeId", "placeName", "placeType", "regionCode"]
    Retrived_data = [{col: place.get(col) for col in cols} for place in data]

   
    df = pd.DataFrame(Retrived_data)

   
    display(df)

else:
    print(f"Error: {response.status_code}")
