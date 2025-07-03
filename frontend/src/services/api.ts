const API_URL = 'http://localhost:8000/api';

export const api = {
  async get(endpoint: string) {
    const response = await fetch(`${API_URL}${endpoint}`);
    if (!response.ok) throw new Error('Network response was not ok');
    return response.json();
  },

  async post(endpoint: string, data: any) {
    const response = await fetch(`${API_URL}${endpoint}`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(data),
    });
    if (!response.ok) throw new Error('Network response was not ok');
    return response.json();
  },
}; 