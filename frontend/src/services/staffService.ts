import { api } from './api';
import type { Staff, CreateStaffData } from '../types/Staff';

export const staffService = {
  async getAllStaff(): Promise<Staff[]> {
    const response = await api.get('/staff');
    return response.data;
  },

  async createStaff(data: CreateStaffData): Promise<{ id: number }> {
    const response = await api.post('/staff', data);
    return response;
  },
}; 