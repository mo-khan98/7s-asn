export interface Shift {
  id: number;
  day: string;
  start_time: string;
  end_time: string;
  role: 'server' | 'cook' | 'manager';
  created_at: string;
  updated_at: string;
}

export interface CreateShiftData {
  day: string;
  start_time: string;
  end_time: string;
  role: 'server' | 'cook' | 'manager';
} 