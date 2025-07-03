export interface Assignment {
  id: number;
  shift_id: number;
  staff_id: number;
  assigned_at: string;
  staff_name: string;
  shift_day: string;
  shift_start_time: string;
  shift_end_time: string;
  shift_role: 'server' | 'cook' | 'manager';
}

export interface CreateAssignmentData {
  shift_id: number;
  staff_id: number;
} 