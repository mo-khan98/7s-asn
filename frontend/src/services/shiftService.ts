import { api } from './api';
import type { Shift, CreateShiftData } from '../types/Shift';
import type { Assignment, CreateAssignmentData } from '../types/Assignment';

export const shiftService = {
  async getAllShifts(): Promise<Shift[]> {
    const response = await api.get('/shifts');
    return response.data;
  },

  async createShift(data: CreateShiftData): Promise<{ id: number }> {
    const response = await api.post('/shifts', data);
    return response;
  },

  async getAllAssignments(): Promise<Assignment[]> {
    const response = await api.get('/assignments');
    return response.data;
  },

  async assignShift(data: CreateAssignmentData): Promise<{ id: number }> {
    const response = await api.post('/assignments', data);
    return response;
  },
}; 